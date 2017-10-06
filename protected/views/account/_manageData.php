<?php 
$data_divider_theme=$user->data_divider_theme(); 
?>

<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Manage Data').': '; ?></li>
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Data'); ?><?php echo Yii::t('translation', 'Manage').': '; ?></li>
	
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/clearData', array('field_id'=>$state_machine->field_id, 'url'=>$state_machine->url, 'id'=>$user->id)); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/erase.png', 'Erase Data', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Mass Delete'); ?> </span>
	</a>
	</li>
	
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/importData', array('field_id'=>$state_machine->field_id, 'url'=>$state_machine->url, 'id'=>$user->id)); ?>">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/import.png', 'Import Data', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Import Data'); ?> </span>
	</a>
	</li>
	
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/exportData', array('field_id'=>$state_machine->field_id, 'url'=>$state_machine->url, 'id'=>$user->id)); ?>">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/export.png', 'Export Data', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Export Data'); ?> </span>
	</a>
	</li>
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Charts').': '; ?></li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/showCharts', array('field_id'=>$state_machine->field_id, 'url'=>$state_machine->url, 'id'=>$user->id)); ?>" data-transition="slide">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/chart.png', 'Change Theme', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Statistics Charts'); ?> </span>
	</a>
	</li>
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'SMS Template').': '; ?></li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('mailSms/indexMailSmsTemplates', array('field_id'=>$state_machine->field_id, 'url'=>$state_machine->url)); ?>" data-transition="slide">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/chart.png', 'SMS Templates', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'SMS Templates'); ?> </span>
	</a>
	</li>
</ul>
		

	