<?php
	$message_body='';
	//$message_recipients='';
	$message_date='';
	$send_date='';
	$message_outbox_count=0;
	$message_sent_count=0;
	$message_outbox_mails=null;
	$message_sent_mails=null;
	$url=$this->getId().'/'.$this->getAction()->getId();
	if(isset($current_mail))
	{		
		$send_date=$current_mail->getSendTime();
		$message_date = $current_mail->getUpdateTime();
		$message_body = $current_mail->message_body;
		$message_outbox_count=$current_mail->getOutBoxMessageCount();
		$message_sent_count=$current_mail->getSentMessageCount();
		$message_outbox_mails=$current_mail->getOutBoxMessages();
		$message_sent_mails=$current_mail->getSentMessages();
	}
	Yii::app()->accountMgr->applyLanguage();
?>
<form>
<ul data-role="listview" data-inset="true" data-dividertheme="<?php echo $data_divider_theme; ?>">
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Recipients').':'; ?></li>
	<li>
	<div class="mail_rec">
	<?php if(isset($current_mail)): ?>
		<?php 
		$recipients=$current_mail->getRecipients();
		$rec_count=count($recipients);
		for($rec_index=0; $rec_index < $rec_count; ++$rec_index):
		$recipient=$recipients[$rec_index];
		?>
			<?php if($recipient->getClassName()===Contact::CLASS_NAME): ?>
				<?php echo CHtml::link($recipient->first_name.' '.$recipient->last_name, array('contact/updateContact', 'id'=>$recipient->id, 'url'=>$url, 'field_id'=>$field_id, 'sub_field_id'=>$sub_field_id), array('data-transition'=>'slide')); ?>
			<?php elseif($recipient->getClassName()===Group::CLASS_NAME): ?>
				<?php echo CHtml::link('+'.$recipient->groupname, array('group/updateGroup', 'id'=>$recipient->id, 'url'=>$url, 'field_id'=>$field_id, 'sub_field_id'=>$sub_field_id), array('data-transition'=>'slide')); ?>
			<?PHP endif; ?>
		<?php endfor; ?>
	<?php endif; ?>
	</div>
	</li>
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Details').':'; ?></li>
	<li>
	<div class="mail_body">
	<?php echo $message_body; ?>
	</div>
	</li>
	<?php if($message_outbox_count > 0 || $message_sent_count > 0): ?>
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Delivery Details').':'; ?></li>
	<li>
	<?php if($message_outbox_count > 0): ?>
	<div data-role="collapsible" data-mini="true">
	<h3><?php echo Yii::t('translation', 'Outbox').': '.$message_outbox_count; ?></h3>
	<p>
	<?php if($message_outbox_count!=0): ?>
	<?php for($index=0; $index < $message_outbox_count; ++$index): ?>
	<?php $mail=$message_outbox_mails[$index]; ?>
	<a href="<?php echo Yii::app()->createUrl('contact/updateContact', array('id'=>$mail->to_contact_id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
	<?php echo $mail->getRecipientName(); ?>
	</a>
	<?php endfor; ?>
	<?php endif; ?>
	</p>
	</div>
	
	<?php endif; ?>
	<?php if($message_sent_count > 0): ?>
	
	<div data-role="collapsible" data-mini="true">
	<h3><?php echo Yii::t('translation', 'Sent').': '.$message_sent_count; ?></h3>
	<p>
	<?php if($message_sent_count!=0): ?>
	<?php for($index=0; $index < $message_sent_count; ++$index): ?>
	<?php $mail=$message_sent_mails[$index]; ?>
	<a href="<?php echo Yii::app()->createUrl('contact/updateContact', array('id'=>$mail->to_contact_id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
	<?php echo $mail->getRecipientName(); ?>
	</a>
	<?php endfor; ?>
	<?php endif; ?>
	</p>
	</div>
	</li>
	<?php endif; ?>
	<?php endif; ?>
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Time Stamps'); ?></li>
	
	<li>
	<p><?php echo Yii::t('translation', 'Send On').':'; ?></p>
	<p class="ui-li-aside"><strong><?php echo $send_date; ?></strong></p>
	</li>
	
	<li>
	<p><?php echo Yii::t('translation', 'Updated On').':'; ?></p>
	<p class="ui-li-aside"><strong><?php echo $message_date; ?></strong></p>
	</li>
</ul>


</form>