<?php
if(!isset($search_keywords))
{
	$search_keywords='';
}

$data_divider_theme=$user->data_divider_theme();

$current_mail=null;
$current_contact=null;
$current_group=null;
// $cs=Yii::app()->getClientScript();
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/nicescroll/jquery.nicescroll.min.js');
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/iscrollview/lib/iscroll.js');
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/iscrollview/lib/jquery.mobile.iscrollview.js');
// $cs->registerCssFile(Yii::app()->baseUrl.'/scripts/iscrollview/lib/jquery.mobile.iscrollview.css');
// $cs->registerCssFile(Yii::app()->baseUrl.'/scripts/iscrollview/lib/jquery.mobile.iscrollview-pull.css');
?>

<?php
$stack_id=$state_machine->stack_id;
$field_id=$state_machine->field_id;
if($field_id==SiteStateMachine::FIELD_CONTACTS)
{
	$current_contact_id=$state_machine->sub_field_id;
	$next_lower_contact_id=$current_contact_id;
	$next_higher_contact_id=$current_contact_id;
	$current_contact=$user->getContactById($current_contact_id);
	
	$contacts=$user->getContacts($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$contact_count=count($contacts);
	for($ci=0; $ci < $contact_count; $ci++)
	{
		$contact=$contacts[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$contact->id;
		}
		if($ci==$contact_count-1)
		{
			$state_machine->page_sub_field_id_min=$contact->id;
		}
		if(!isset($current_contact))
		{
			$current_contact_id=$contact->id;
			$state_machine->sub_field_id=$current_contact_id;
			$current_contact=$contact;
		}
	}
	if(isset($current_contact))
	{
		$current_contact_id=$current_contact->id;
		$next_lower_contact_id=$user->getNextLowerContactId($current_contact_id, $search_keywords);
		$next_higher_contact_id=$user->getNextHigherContactId($current_contact_id, $search_keywords);
	}
}
else if($field_id==SiteStateMachine::FIELD_GROUPS)
{
	$current_group_id=$state_machine->sub_field_id;
	$next_lower_group_id=$current_group_id;
	$next_higher_group_id=$current_group_id;
	$current_group=$user->getGroupById($current_group_id);
	
	$groups=$user->getGroups($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$group_count=count($groups);
	for($ci=0; $ci < $group_count; $ci++)
	{
		$group=$groups[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$group->id;
		}
		if($ci==$group_count-1)
		{
			$state_machine->page_sub_field_id_min=$group->id;
		}
		if(!isset($current_group))
		{
			$current_group_id=$group->id;
			$state_machine->sub_field_id=$current_group_id;
			$current_group=$group;
		}
	}
	if(isset($current_group))
	{
		$current_group_id=$current_group->id;
		$next_lower_group_id=$user->getNextLowerGroupId($current_group_id, $search_keywords);
		$next_higher_group_id=$user->getNextHigherGroupId($current_group_id, $search_keywords);
	}
}
else if($field_id==SiteStateMachine::FIELD_OUTBOX)
{
	$current_outbox_id=$state_machine->sub_field_id;
	$next_lower_outbox_id=$current_outbox_id;
	$next_higher_outbox_id=$current_outbox_id;
	$current_outbox=$user->getOutboxById($current_outbox_id);
	
	$mails=$user->getOutboxs($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$outbox_count=count($mails);
	$outboxs=array();
	for($ci=0; $ci < $outbox_count; $ci++)
	{
		$outbox=$mails[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$outbox->id;
		}
		if($ci==$outbox_count-1)
		{
			$state_machine->page_sub_field_id_min=$outbox->id;
		}
		if(!isset($current_outbox))
		{
			$current_outbox_id=$outbox->id;
			$state_machine->sub_field_id=$current_outbox_id;
			$current_outbox=$outbox;
		}
		$key=$outbox->getSendDate();
		if(!isset($outboxs[$key]))
		{
			$outboxs[$key]=array();
		}
		$outboxs[$key][]=$outbox;
	}
	if(isset($current_outbox))
	{
		$current_outbox_id=$current_outbox->id;
		$next_lower_outbox_id=$user->getNextLowerOutboxId($current_outbox_id, $search_keywords);
		$next_higher_outbox_id=$user->getNextHigherOutboxId($current_outbox_id, $search_keywords);
	}
}
else if($field_id==SiteStateMachine::FIELD_DRAFT)
{
	$current_draft_id=$state_machine->sub_field_id;
	$next_lower_draft_id=$current_draft_id;
	$next_higher_draft_id=$current_draft_id;
	$current_draft=$user->getDraftById($current_draft_id);
	
	$mails=$user->getDrafts($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$draft_count=count($mails);
	$drafts=array();
	for($ci=0; $ci < $draft_count; $ci++)
	{
		$draft=$mails[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$draft->id;
		}
		if($ci==$draft_count-1)
		{
			$state_machine->page_sub_field_id_min=$draft->id;
		}
		if(!isset($current_draft))
		{
			$current_draft_id=$draft->id;
			$state_machine->sub_field_id=$current_draft_id;
			$current_draft=$draft;
		}
		$key=$draft->getUpdateDate();
		if(!isset($drafts[$key]))
		{
			$drafts[$key]=array();
		}
		$drafts[$key][]=$draft;
	}
	if(isset($current_draft))
	{
		$current_draft_id=$current_draft->id;
		$next_lower_draft_id=$user->getNextLowerDraftId($current_draft_id, $search_keywords);
		$next_higher_draft_id=$user->getNextHigherDraftId($current_draft_id, $search_keywords);
	}
}
else if($field_id==SiteStateMachine::FIELD_SENT)
{
	$current_sentMail_id=$state_machine->sub_field_id;
	$next_lower_sentMail_id=$current_sentMail_id;
	$next_higher_sentMail_id=$current_sentMail_id;
	$current_sentMail=$user->getSentMailById($current_sentMail_id);
	
	$mails=$user->getSentMails($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$sentMail_count=count($mails);
	$sentMails=array();
	for($ci=0; $ci < $sentMail_count; $ci++)
	{
		$sentMail=$mails[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$sentMail->id;
		}
		if($ci==$sentMail_count-1)
		{
			$state_machine->page_sub_field_id_min=$sentMail->id;
		}
		if(!isset($current_sentMail))
		{
			$current_sentMail_id=$sentMail->id;
			$state_machine->sub_field_id=$current_sentMail_id;
			$current_sentMail=$sentMail;
		}
		$key=$sentMail->getSendDate();
		if(!isset($sentMails[$key]))
		{
			$sentMails[$key]=array();
		}
		$sentMails[$key][]=$sentMail;
	}
	if(isset($current_sentMail))
	{
		$current_sentMail_id=$current_sentMail->id;
		$next_lower_sentMail_id=$user->getNextLowerSentMailId($current_sentMail_id, $search_keywords);
		$next_higher_sentMail_id=$user->getNextHigherSentMailId($current_sentMail_id, $search_keywords);
	}
}
else if($field_id==SiteStateMachine::FIELD_TRASH)
{
	$current_trashMail_id=$state_machine->sub_field_id;
	$next_lower_trashMail_id=$current_trashMail_id;
	$next_higher_trashMail_id=$current_trashMail_id;
	$current_trashMail=$user->getTrashMailById($current_trashMail_id);
	
	$mails=$user->getTrashMails($state_machine->sub_field_id, $state_machine->page_sub_field_id_max, $state_machine->page_sub_field_id_min, $search_keywords); 
	$trashMail_count=count($mails);
	$trashMails=array();
	for($ci=0; $ci < $trashMail_count; $ci++)
	{
		$trashMail=$mails[$ci];
		if($ci==0)
		{
			$state_machine->page_sub_field_id_max=$trashMail->id;
		}
		if($ci==$trashMail_count-1)
		{
			$state_machine->page_sub_field_id_min=$trashMail->id;
		}
		if(!isset($current_trashMail))
		{
			$current_trashMail_id=$trashMail->id;
			$state_machine->sub_field_id=$current_trashMail_id;
			$current_trashMail=$trashMail;
		}
		$key=$trashMail->getUpdateDate();
		if(!isset($trashMails[$key]))
		{
			$trashMails[$key]=array();
		}
		$trashMails[$key][]=$trashMail;
	}
	if(isset($current_trashMail))
	{
		$current_trashMail_id=$current_trashMail->id;
		$next_lower_trashMail_id=$user->getNextLowerTrashMailId($current_trashMail_id, $search_keywords);
		$next_higher_trashMail_id=$user->getNextHigherTrashMailId($current_trashMail_id, $search_keywords);
	}
}
?>

<?php if($stack_id==0): ?>
<div>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Account').': '; ?></li>
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Folders').': '; ?></li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_OUTBOX) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_OUTBOX, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/outbox.png', 'Outbox', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Outbox'); ?> <span class="ui-li-count"><?php echo $user->getOutboxCount(); ?></span>
		</a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_DRAFT) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_DRAFT, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/draft.png', 'Draft', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Draft'); ?> <span class="ui-li-count"><?php echo $user->getDraftCount(); ?></span>
		</a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_SENT) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_SENT, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/sent.png', 'Sent', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Sent'); ?> <span class="ui-li-count"><?php echo $user->getSentMailCount(); ?></span>
		</a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_TRASH) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_TRASH, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/trash.png', 'Trash', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Trash'); ?> <span class="ui-li-count"><?php echo $user->getTrashMailCount(); ?></span>
		</a>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="<?php echo Yii::app()->createUrl('mailSms/compose', array('url'=>'mobile/index', 'field_id'=>SiteStateMachine::FIELD_SENT)); ?>" data-role="button" data-icon="plus" data-transition="slide"><?php echo Yii::t('translation', 'Compose'); ?></a>
		</div>
		</li>
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Contacts').': '; ?></li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_CONTACTS) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_CONTACTS, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/user.png', 'Contacts', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Contacts'); ?> <span class="ui-li-count"><?php echo $user->getContactCount(); ?></span>
		</a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_GROUPS) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_GROUPS, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/group.png', 'Groups', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Groups'); ?> <span class="ui-li-count"><?php echo $user->getGroupCount(); ?></span>
		</a>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal" >
		<a href="<?php echo Yii::app()->createUrl('contact/addContact', array('url'=>'mobile/index', 'field_id'=>SiteStateMachine::FIELD_CONTACTS)); ?>" data-role="button" data-icon="plus" data-transition="slide"><?php echo Yii::t('translation', 'Contact'); ?></a>
		<a href="<?php echo Yii::app()->createUrl('group/addGroup', array('url'=>'mobile/index', 'field_id'=>SiteStateMachine::FIELD_GROUPS)); ?>" data-role="button" data-icon="plus" data-transition="slide"><?php echo Yii::t('translation', 'Group'); ?></a>
		</div>
		</li>
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Tasks').': '; ?></li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_CALENDAR) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_CALENDAR, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/calender.png', 'Manage Data', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Manage Data'); ?></a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_TASK) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_TASK, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/tasks.png', 'Tasks', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Tasks'); ?> 	<span class="ui-li-count"><?php echo $user->getTaskCount(); ?></span>
		</a>
		</li>
		<li <?php if($state_machine->field_id==SiteStateMachine::FIELD_SETTINGS) echo 'data-theme="e"'; ?> >
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'stack_id'=>1)); ?>">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/settings.png', 'Settings', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Settings'); ?></a>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="<?php echo Yii::app()->createUrl('mobile/index'); ?>" data-role="button" data-icon="plus" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Task'); ?></a>
		<a href="<?php echo Yii::app()->createUrl('mobile/index'); ?>" data-role="button" data-icon="plus" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Note'); ?></a>
		</div>
		</li>
	</ul>
</div>

<?php elseif($stack_id==1): ?>

<div>
	
	<?php if($state_machine->field_id==SiteStateMachine::FIELD_SETTINGS): ?>
	<?php $this->renderPartial('../account/_settings', array('model'=>$user, 'state_machine'=>$state_machine)); ?>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_CALENDAR): ?>
	<?php $this->renderPartial('../account/_manageData', array('user'=>$user, 'state_machine'=>$state_machine)); ?>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_TASK): ?>
	<?php $this->renderPartial('../mailSms/_indexTasks', array('user'=>$user, 'state_machine'=>$state_machine)); ?>
	
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_OUTBOX): ?>
	
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Outbox').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxOutboxMailCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxOutboxMailCountPerPage(); ?></a>
		</div>
		</li>
		

		<?php foreach($outboxs as $key => $group_mails): ?>
			<?php $group_mail_count=count($group_mails); ?>
			<?php for($group_mail_index=0; $group_mail_index < $group_mail_count; ++$group_mail_index): ?>
					<?php $mail=$group_mails[$group_mail_index]; ?>
					
					<?php if($group_mail_index==0): ?>
						<li data-role="list-divider"><?php echo $mail->getSendDate(); ?> <span class="ui-li-count"><?php echo $group_mail_count; ?></span></li>
					<?php endif; ?>
					
					
					<li <?php if($mail->id==$state_machine->sub_field_id) echo 'data-theme="e"'; ?> >
					
					<a href="<?php echo Yii::app()->createUrl('mobile/index',
						array('field_id'=>$state_machine->field_id, 
							'sub_field_id'=>$mail->id, 
							'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
							'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
							'stack_id'=>2,
						)); 
						?>">
					<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mail.png', 'Message', array('class'=>'ui-li-icon')); ?> 
					<p><strong><?php echo $mail->getFormattedRecipients(); ?></strong></p>
					<p><?php echo $mail->message_body; ?></p>
					<p class="ui-li-aside"><strong><?php echo $mail->getSendTime(); ?></strong></p>
					 <span class="ui-li-count"><?php echo $mail->getOutBoxMessageCount(); ?></span>
				
					</a>
					</li>

			<?php endfor; ?>
		<?php endforeach; ?>
		
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_DRAFT): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Draft').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxDraftMailCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxDraftMailCountPerPage(); ?></a>
		</div>
		</li>
		

		<?php foreach($drafts as $key => $group_mails): ?>
			<?php $group_mail_count=count($group_mails); ?>
			<?php for($group_mail_index=0; $group_mail_index < $group_mail_count; ++$group_mail_index): ?>
					<?php $mail=$group_mails[$group_mail_index]; ?>
					
					<?php if($group_mail_index==0): ?>
						<li data-role="list-divider"><?php echo $mail->getUpdateDate(); ?> <span class="ui-li-count"><?php echo $group_mail_count; ?></span></li>
					<?php endif; ?>
					
					
					<li <?php if($mail->id==$state_machine->sub_field_id) echo 'data-theme="e"'; ?> >
					
					<a href="<?php echo Yii::app()->createUrl('mobile/index',
						array('field_id'=>$state_machine->field_id, 
							'sub_field_id'=>$mail->id, 
							'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
							'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
							'stack_id'=>2,
						)); 
						?>">
						
					<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mail.png', 'Message', array('class'=>'ui-li-icon')); ?> 
					<p><strong><?php echo $mail->getFormattedRecipients(); ?></strong></p>
					<p><?php echo $mail->message_body; ?></p>
					<p class="ui-li-aside"><strong><?php echo $mail->getUpdateTime(); ?></strong></p>
					</a>
					</li>

			<?php endfor; ?>
		<?php endforeach; ?>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_SENT): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Sent').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxSentMailCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxSentMailCountPerPage(); ?></a>
		</div>
		</li>
		
		<?php foreach($sentMails as $key => $group_mails): ?>
			<?php $group_mail_count=count($group_mails); ?>
			<?php for($group_mail_index=0; $group_mail_index < $group_mail_count; ++$group_mail_index): ?>
					<?php $mail=$group_mails[$group_mail_index]; ?>
					
					<?php if($group_mail_index==0): ?>
						<li data-role="list-divider"><?php echo $mail->getSendDate(); ?> <span class="ui-li-count"><?php echo $group_mail_count; ?></span></li>
					<?php endif; ?>
					
					
					<li <?php if($mail->id==$state_machine->sub_field_id) echo 'data-theme="e"'; ?> >
					
					<a href="<?php echo Yii::app()->createUrl('mobile/index',
						array('field_id'=>$state_machine->field_id, 
							'sub_field_id'=>$mail->id, 
							'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
							'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
							'stack_id'=>2,
						)); 
						?>">
					<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mail.png', 'Message', array('class'=>'ui-li-icon')); ?> 
					<p><strong><?php echo $mail->getFormattedRecipients(); ?></strong></p>
					<p><?php echo $mail->message_body; ?></p>
					<p class="ui-li-aside"><strong><?php echo $mail->getSendTime(); ?></strong></p>
					</a>
					</li>

			<?php endfor; ?>
		<?php endforeach; ?>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_TRASH): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Trash').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxTrashMailCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxTrashMailCountPerPage(); ?></a>
		</div>
		</li>
		
		<?php foreach($trashMails as $key => $group_mails): ?>
			<?php $group_mail_count=count($group_mails); ?>
			<?php for($group_mail_index=0; $group_mail_index < $group_mail_count; ++$group_mail_index): ?>
					<?php $mail=$group_mails[$group_mail_index]; ?>
					
					<?php if($group_mail_index==0): ?>
						<li data-role="list-divider"><?php echo $mail->getUpdateDate(); ?> <span class="ui-li-count"><?php echo $group_mail_count; ?></span></li>
					<?php endif; ?>
					
					
					<li <?php if($mail->id==$state_machine->sub_field_id) echo 'data-theme="e"'; ?> >
					
					<a href="<?php echo Yii::app()->createUrl('mobile/index',
						array('field_id'=>$state_machine->field_id, 
							'sub_field_id'=>$mail->id, 
							'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
							'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
							'stack_id'=>2,
						)); 
						?>">
					<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mail.png', 'Message', array('class'=>'ui-li-icon')); ?> 
					<p><strong><?php echo $mail->getFormattedRecipients(); ?></strong></p>
					<p><?php echo $mail->message_body; ?></p>
					<p class="ui-li-aside"><strong><?php echo $mail->getUpdateTime(); ?></strong></p>
					</a>
					</li>

			<?php endfor; ?>
		<?php endforeach; ?>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_CONTACTS): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Contacts').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxContactCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxContactCountPerPage(); ?></a>
		</div>
		</li>
		
		<?php for($ci=0; $ci < $contact_count; $ci++): ?>						
			<?php $contact=$contacts[$ci]; ?>
			
			<li <?php if($contact->id==$current_contact_id) echo 'data-theme="e"'; ?> >
			<a href="<?php 
				echo Yii::app()->createUrl('mobile/index', 
					array('field_id'=>$state_machine->field_id, 
						'sub_field_id'=>$contact->id, 
						'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
						'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
						'stack_id'=>2,
						)
					); 
				?>">
			<?php echo CHtml::image($contact->getImagePathIfFileExists(), 'Contact'); ?> 
			<p><strong><?php echo $contact->first_name.' '.$contact->last_name; ?></strong></p>
			<p><?php echo $contact->email1; ?></p>
			<p><?php echo $contact->txt_field1; ?></p>
			<p class="ui-li-aside"><strong><?php echo $contact->phone1; ?></strong></p>
			</a>
			</li>
		<?php endfor; ?>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_GROUPS): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Groups').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="fieldcontain" data-mini="true">
			<label for="search_keywords_<?php echo $state_machine->field_id; ?>"><?php echo Yii::t('translation', 'Search'); ?>: </label>
			<input type="search" name="search_keywords_<?php echo $state_machine->field_id; ?>" id="search_keywords_<?php echo $state_machine->field_id; ?>" value="<?php echo $search_keywords; ?>" data-mini="true" />
		</div>
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<a href="#" onclick="search_by_keywords(); return false;" data-role="button" data-icon="search"><?php echo Yii::t('translation', 'Search'); ?></a>
		<a href="#" onclick="next_page(); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next').' '.$user->getMaxGroupCountPerPage(); ?></a>
		<a href="#" onclick="prev_page(); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Prev').' '.$user->getMaxGroupCountPerPage(); ?></a>
		</div>
		</li>
		
		<?php for($ci=0; $ci < $group_count; $ci++): ?>						
			<?php $group=$groups[$ci]; ?>
			
			<li <?php if($group->id==$current_group_id) echo 'data-theme="e"'; ?> >
			<a href="<?php 
				echo Yii::app()->createUrl('mobile/index', 
					array('field_id'=>$state_machine->field_id, 
						'sub_field_id'=>$group->id, 
						'page_sub_field_id_max'=>$state_machine->page_sub_field_id_max,
						'page_sub_field_id_min'=>$state_machine->page_sub_field_id_min,
						'stack_id'=>2,
						)
					); 
				?>">
			<?php echo CHtml::image($group->getImagePathIfFileExists(), 'Group'); ?> 
			<p><strong><?php echo $group->groupname; ?></strong></p>
			<span class="ui-li-count"><?php echo $group->getContactCount(); ?></span>
			<p class="ui-li-aside"><strong><?php echo $group->org_name; ?></strong></p>
			</a>
			</li>
		<?php endfor; ?>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_CALENDAR): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Manage Data').': '; ?></li>
	</ul>
	<?php endif; ?>
</div>

<?php else: ?>

<div>
	<?php if($state_machine->field_id==SiteStateMachine::FIELD_OUTBOX): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Outbox').' '.Yii::t('translation', 'Message').': '; ?>
		</li>
		
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_outbox_id!=$next_lower_outbox_id && $next_lower_outbox_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_outbox_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Sent SMS'); ?></a>
		<?php endif; ?>
		<?php if($current_outbox_id!=$next_higher_outbox_id && $next_higher_outbox_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_outbox_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Sent SMS'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../mailSms/_viewMailSms', array('current_mail'=>$current_outbox, 'data_divider_theme'=>$data_divider_theme, 'field_id'=>$state_machine->field_id, 'sub_field_id'=>$state_machine->sub_field_id, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
			<?php if(isset($current_outbox)): ?>
			<a href="<?php echo Yii::app()->createUrl('mailSms/deleteMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_outbox_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_outbox_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Action'); ?></a>
			<?php endif; ?>
		</div>
		</li>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_DRAFT): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Draft').' '.Yii::t('translation', 'Message').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_draft_id!=$next_lower_draft_id && $next_lower_draft_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_draft_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Draft SMS'); ?></a>
		<?php endif; ?>
		<?php if($current_draft_id!=$next_higher_draft_id && $next_higher_draft_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_draft_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Draft	SMS'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../mailSms/_viewMailSms', array('current_mail'=>$current_draft, 'data_divider_theme'=>$data_divider_theme, 'field_id'=>$state_machine->field_id, 'sub_field_id'=>$state_machine->sub_field_id, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if(isset($current_draft)): ?>
			<a href="<?php echo Yii::app()->createUrl('mailSms/deleteMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_draft_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_draft_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Action'); ?></a>
		<?php endif; ?>
		</div>
		</li>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_SENT): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Sent').' '.Yii::t('translation', 'Message').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_sentMail_id!=$next_lower_sentMail_id && $next_lower_sentMail_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_sentMail_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Sent SMS'); ?></a>
		<?php endif; ?>
		<?php if($current_sentMail_id!=$next_higher_sentMail_id && $next_higher_sentMail_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_sentMail_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Sent SMS'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../mailSms/_viewMailSms', array('current_mail'=>$current_sentMail, 'data_divider_theme'=>$data_divider_theme, 'field_id'=>$state_machine->field_id, 'sub_field_id'=>$state_machine->sub_field_id, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if(isset($current_sentMail)): ?>
			<a href="<?php echo Yii::app()->createUrl('mailSms/deleteMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_sentMail_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_sentMail_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Action'); ?></a>
		<?php endif; ?>
		</div>
		</li>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_TRASH): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Trash').' '.Yii::t('translation', 'Message').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_trashMail_id!=$next_lower_trashMail_id && $next_lower_trashMail_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_trashMail_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Sent SMS'); ?></a>
		<?php endif; ?>
		<?php if($current_trashMail_id!=$next_higher_trashMail_id && $next_higher_trashMail_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_trashMail_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Sent SMS'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../mailSms/_viewMailSms', array('current_mail'=>$current_trashMail, 'data_divider_theme'=>$data_divider_theme, 'field_id'=>$state_machine->field_id, 'sub_field_id'=>$state_machine->sub_field_id, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if(isset($current_trashMail)): ?>
			<a href="<?php echo Yii::app()->createUrl('mailSms/deleteMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_trashMail_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'id'=>$current_trashMail_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Action'); ?></a>
		<?php endif; ?>
		</div>
		</li>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_CONTACTS): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Contact').': '; ?></li>
				
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_contact_id!=$next_lower_contact_id && $next_lower_contact_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_contact_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Contact'); ?></a>
		<?php endif; ?>
		<?php if($current_contact_id!=$next_higher_contact_id && $next_higher_contact_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_contact_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Contact'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../contact/_viewContact', array('current_contact'=>$current_contact, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
			<a href="<?php echo Yii::app()->createUrl('contact/deleteContact', array('id'=>$current_contact_id, 'url'=>'mobile/index', 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('contact/updateContact', array('id'=>$current_contact_id, 'url'=>'mobile/index', 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Update'); ?></a>
		</div>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
			<a href="<?php echo Yii::app()->createUrl('contact/addContactToGroup', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'contact_id'=>$current_contact_id)); ?>" data-role="button" data-icon="plus"><?php echo Yii::t('translation', 'Add to Group'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('contact/removeContactFromGroup', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'contact_id'=>$current_contact_id)); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Remove From Group'); ?></a>
		</div>
		</li>
	</ul>
	<?php elseif($state_machine->field_id==SiteStateMachine::FIELD_GROUPS): ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Contact').' '.Yii::t('translation', 'Group').': '; ?></li>
		
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
		<?php if($current_group_id!=$next_lower_group_id && $next_lower_group_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_lower_group_id; ?>); return false;" data-role="button" data-icon="arrow-d"><?php echo Yii::t('translation', 'Next Group'); ?></a>
		<?php endif; ?>
		<?php if($current_group_id!=$next_higher_group_id && $next_higher_group_id != -1): ?>
		<a href="#" onclick="go_to_record(<?php echo $next_higher_group_id; ?>); return false;" data-role="button" data-icon="arrow-u"><?php echo Yii::t('translation', 'Previous Group'); ?></a>
		<?php endif; ?>
		</div>
		</li>
		
		<li>
		<?php $this->renderPartial('../group/_viewGroup', array('current_group'=>$current_group, 'state_machine'=>$state_machine)); ?>
		</li>
		<li data-role="list-divider">
		<div data-role="controlgroup" data-mini="true" data-type="horizontal">
			<a href="<?php echo Yii::app()->createUrl('group/deleteGroup', array('id'=>$current_group_id, 'url'=>'mobile/index', 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="delete" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Delete'); ?></a>
			<a href="<?php echo Yii::app()->createUrl('group/updateGroup', array('id'=>$current_group_id, 'url'=>'mobile/index', 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide"><?php echo Yii::t('translation', 'Update'); ?></a>
		</div>
		</li>
	</ul>
	<?php endif; ?>
</div>

<?php endif; ?>

<script type="text/javascript">
function search_by_keywords()
{
	var field_id=<?php echo $state_machine->field_id; ?>;
	var page_sub_field_id_max=-1;
	var page_sub_field_id_min=-1;
	var sub_field_id=-1;
	var search_keywords=escape("<?php echo $search_keywords; ?>");
	if($("#search_keywords_"+field_id).length)
	{
		search_keywords=escape($("#search_keywords_"+field_id).val());
	}
	request_result(field_id, sub_field_id, page_sub_field_id_max, page_sub_field_id_min, search_keywords, 1);
}
function request_result(field_id, sub_field_id, page_sub_field_id_max, page_sub_field_id_min, search_keywords, stack_id)
{
	var url = "<?php echo Yii::app()->createUrl('mobile/index'); ?>&field_id="+field_id+"&sub_field_id="+sub_field_id+"&page_sub_field_id_max="+page_sub_field_id_max+"&page_sub_field_id_min="+page_sub_field_id_min+"&search_keywords="+search_keywords+"&stack_id="+stack_id;
	$.mobile.showPageLoadingMsg();
	window.location.href=url;
}
function next_page()
{
	var field_id=<?php echo $state_machine->field_id; ?>;
	var sub_field_id=-3; //next
	var page_sub_field_id_max=<?php echo $state_machine->page_sub_field_id_max; ?>;
	var page_sub_field_id_min=<?php echo $state_machine->page_sub_field_id_min; ?>;
	var search_keywords=escape("<?php echo $search_keywords; ?>");
	request_result(field_id, sub_field_id, page_sub_field_id_max, page_sub_field_id_min, search_keywords, 1);
}
function prev_page()
{
	var field_id=<?php echo $state_machine->field_id; ?>;
	var sub_field_id=-2; //prev
	var page_sub_field_id_max=<?php echo $state_machine->page_sub_field_id_max; ?>;
	var page_sub_field_id_min=<?php echo $state_machine->page_sub_field_id_min; ?>;
	var search_keywords=escape("<?php echo $search_keywords; ?>");
	request_result(field_id, sub_field_id, page_sub_field_id_max, page_sub_field_id_min, search_keywords, 1);
}
function go_to_record(record_id)
{
	var field_id=<?php echo $state_machine->field_id; ?>;
	var sub_field_id=record_id;
	var page_sub_field_id_max=<?php echo $state_machine->page_sub_field_id_max; ?>;
	var page_sub_field_id_min=<?php echo $state_machine->page_sub_field_id_min; ?>;
	var search_keywords=escape("<?php echo $search_keywords; ?>");
	request_result(field_id, sub_field_id, page_sub_field_id_max, page_sub_field_id_min, search_keywords, 2);
}
</script>


