<?php 
$username=$user->username;
if(isset($user->first_name))
{
	$username=$user->first_name.' '.$user->last_name;
}
$data_theme=$user->getTheme(); 
$data_divider_theme=$user->data_divider_theme(); 

$current_task_id=$state_machine->sub_field_id;
$next_lower_task_id=$current_task_id;
$next_higher_task_id=$current_task_id;
$current_task=$user->getTaskById($current_task_id);

$tasks=$user->getTasks($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min); 
$task_count=count($tasks);
for($ci=0; $ci < $task_count; $ci++)
{
	$task=$tasks[$ci];
	if($ci==0)
	{
		$state_machine->page_sub_field_id_max=$task->id;
	}
	if($ci==$task_count-1)
	{
		$state_machine->page_sub_field_id_min=$task->id;
	}
	if(!isset($current_task))
	{
		$current_task_id=$task->id;
		$state_machine->sub_field_id=$current_task_id;
		$current_task=$task;
	}
}
if(isset($current_task))
{
	$current_task_id=$current_task->id;
	$next_lower_task_id=$user->getNextLowerTaskId($current_task_id);
	$next_higher_task_id=$user->getNextHigherTaskId($current_task_id);
}

?>

<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Tasks').': '.$username; ?></li>
	<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="<?php 
			echo Yii::app()->createUrl('site/index',
				array('field_id'=>$state_machine->field_id,
					'sub_field_id'=>-3, //next
					'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
					'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min
				)
			); 
			?>" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next'); ?></a>
		<a href="<?php 
			echo Yii::app()->createUrl('site/index',
				array('field_id'=>$state_machine->field_id,
					'sub_field_id'=>-2, //prev
					'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
					'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min
				)
			); 
			?>" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev'); ?></a>
		<a href="<?php echo Yii::app()->createUrl('mailSms/addTask',
				array(
				'field_id'=>SiteStateMachine::FIELD_TASK, 
				'url'=>'site/index',
				'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
				'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
				)
			); 
			?>" data-role="button" data-icon="plus" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Task'); ?></a>
		</div>
	</li>
	<li>
	<div class="ui-grid-a" style="height:540px;">		
		<?php for($ci=0; $ci < $task_count; $ci++): ?>						
			<?php $task=$tasks[$ci]; ?>
			<?php
			$task_column='a';
			if($ci % 3==1)
			{
				$task_column='b';
			}
			$icon='star';
			if($task->status==MailSms::STATUS_TASK_ACTIVE)
			{
				$icon='alert';
			}
			else if($task->status==MailSms::STATUS_TASK_COMPLETED)
			{
				$icon='star';
			}
			else if($task->status==MailSms::STATUS_TASK_INACTIVE)
			{
				$icon='delete';
			}
			?>
			<div class="ui-block-<?php echo $task_column; ?>">
				<a href="<?php echo Yii::app()->createUrl('mailSms/updateTask', 
					array('id'=>$task->id, 
						'field_id'=>SiteStateMachine::FIELD_TASK, 
						'url'=>'site/index',
						'task_id'=>$task->id,
						)
					); 
				?>" data-role="button" data-rel="dialog" data-transition="pop" data-icon="<?php echo $icon; ?>"><?php echo $task->dat_field2.': '.$task->message_body; ?></a>
			</div>
		<?php endfor; ?>
	</div><!-- /grid-b -->
	</li>
	
</ul>


		

	