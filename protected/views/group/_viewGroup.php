<?php
	$group_number='';
	$mail='';
	$create_time='';
	$org='';
	$username='';
	$group_contact_count=0;
	$group_outbox_mail_count=0;
	$group_draft_mail_count=0;
	$group_sent_mail_count=0;
	$group_trash_mail_count=0;
	
	$group_outbox_mails=null;
	$group_draft_mails=null;
	$group_sent_mails=null;
	$group_trash_mails=null;
	$group_contacts=null;
	
	$group_id=-1;
	
	$url=$this->getId().'/'.$this->getAction()->getId();
	
	if(isset($current_group))
	{
		$create_time = $current_group->dat_field1;
		$org=$current_group->org_name;
		
		$username=$current_group->groupname;
		
		$group_contacts=$current_group->getContacts();
		$group_contact_count=$current_group->getContactCount();
		
		$group_outbox_mails=$current_group->getOutboxMails();
		$group_draft_mails=$current_group->getDraftMails();
		$group_sent_mails=$current_group->getSentMails();
		$group_trash_mails=$current_group->getTrashMails();
		
		$group_outbox_mail_count=count($group_outbox_mails);
		$group_draft_mail_count=count($group_draft_mails);
		$group_sent_mail_count=count($group_sent_mails);
		$group_trash_mail_count=count($group_trash_mails);
		
		$group_id=$current_group->id;
	}
	
	Yii::app()->accountMgr->applyLanguage();
?>
<form>
<ul data-role="listview" data-inset="true">
	
	<li style="height:140px">
	<?php if(isset($current_group)): ?>
	<?php echo CHtml::image($current_group->getImagePathIfFileExists(), 'Group', array('style'=>'padding:10px;width:120px;height:140px;')); ?> 
	<?php endif; ?>
	</li>
	
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Name'); ?>: <?php echo $username; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Create Date'); ?>: <?php echo $create_time; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Org'); ?>: <?php echo $org; ?>
	</li>
</ul>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Contacts').': '.$group_contact_count; ?></h3>
<p>
<?php if($group_contact_count!=0): ?>
<?php for($index=0; $index < $group_contact_count; ++$index): ?>
<?php $contact=$group_contacts[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('contact/updateContact', array('id'=>$contact->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $contact->first_name.' '.$contact->last_name; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Outbox').': '.$group_outbox_mail_count; ?></h3>
<p>
<?php if($group_outbox_mail_count!=0): ?>
<?php for($index=0; $index < $group_outbox_mail_count; ++$index): ?>
<?php $mail=$group_outbox_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $group_outbox_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Sent').': '.$group_sent_mail_count; ?></h3>
<p>
<?php if($group_sent_mail_count!=0): ?>
<?php for($index=0; $index < $group_sent_mail_count; ++$index): ?>
<?php $mail=$group_sent_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $group_sent_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Draft').': '.$group_draft_mail_count; ?></h3>
<p>
<?php if($group_draft_mail_count!=0): ?>
<?php for($index=0; $index < $group_draft_mail_count; ++$index): ?>
<?php $mail=$group_draft_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $group_draft_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Trash').': '.$group_trash_mail_count; ?></h3>
<p>
<?php if($group_trash_mail_count!=0): ?>
<?php for($index=0; $index < $group_trash_mail_count; ++$index): ?>
<?php $mail=$group_trash_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $group_trash_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>



</form>