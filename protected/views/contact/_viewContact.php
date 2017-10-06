<?php
	$contact_number='';
	$mail='';
	$create_time='';
	$org='';
	$username='';
	
	$contact_outbox_mail_count=0;
	$contact_draft_mail_count=0;
	$contact_sent_mail_count=0;
	$contact_trash_mail_count=0;
	
	$contact_outbox_mails=null;
	$contact_draft_mails=null;
	$contact_sent_mails=null;
	$contact_trash_mails=null;
	
	$groups=null;
	$group_count=0;
	
	$contact_id=-1;
	
	$url=$this->getId().'/'.$this->getAction()->getId();
	
	if(isset($current_contact))
	{
		$contact_number = $current_contact->phone1;
		$create_time = $current_contact->create_time;
		$mail = $current_contact->email1;
		$org=$current_contact->txt_field1;
		
		$username=$current_contact->username;
		if(isset($current_contact->first_name))
		{
			$username=$current_contact->first_name.' '.$current_contact->last_name;
		}
		
		$contact_outbox_mails=$current_contact->getOutboxMails();
		$contact_draft_mails=$current_contact->getDraftMails();
		$contact_sent_mails=$current_contact->getSentMails();
		$contact_trash_mails=$current_contact->getTrashMails();
		
		$contact_outbox_mail_count=count($contact_outbox_mails);
		$contact_draft_mail_count=count($contact_draft_mails);
		$contact_sent_mail_count=count($contact_sent_mails);
		$contact_trash_mail_count=count($contact_trash_mails);
		
		$groups=$current_contact->getGroups();
		$group_count=count($groups);
	}
	
	Yii::app()->accountMgr->applyLanguage();
?>
<form>
<ul data-role="listview" data-inset="true">
	
	<li style="height:140px">
	<?php if(isset($current_contact)): ?>
	<?php echo CHtml::image($current_contact->getImagePathIfFileExists(), 'Contact', array('style'=>'padding:10px;width:100px;display: block;')); ?> 
	<?php endif; ?>
	</li>
	
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Name'); ?>: <?php echo $username; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Create Date'); ?>: <?php echo $create_time; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Contact Number'); ?>: <?php echo $contact_number; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Email'); ?>: <?php echo $mail; ?>
	</li>
	<li data-role="fieldcontain">
		<?php echo Yii::t('translation', 'Description'); ?>: <?php $org; ?>
	</li>
	
</ul>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Group').': '.$group_count; ?></h3>
<p>
<?php if($group_count!=0): ?>
<?php for($index=0; $index < $group_count; ++$index): ?>
<?php $group=$groups[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('group/updateGroup', array('id'=>$group->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $groups[$index]->groupname; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>


<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Outbox').': '.$contact_outbox_mail_count; ?></h3>
<p>
<?php if($contact_outbox_mail_count!=0): ?>
<?php for($index=0; $index < $contact_outbox_mail_count; ++$index): ?>
<?php $mail=$contact_outbox_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $contact_outbox_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>

<div data-role="collapsible" data-mini="true">
<h3><?php echo Yii::t('translation', 'Sent').': '.$contact_sent_mail_count; ?></h3>
<p>
<?php if($contact_sent_mail_count!=0): ?>
<?php for($index=0; $index < $contact_sent_mail_count; ++$index): ?>
<?php $mail=$contact_sent_mails[$index]; ?>
<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('id'=>$mail->id, 'url'=>$url, 'field_id'=>$state_machine->field_id)); ?>" data-role="button" data-icon="check" data-transition="slide" data-mini="true">
<?php echo $contact_sent_mails[$index]->message_body; ?>
</a>
<?php endfor; ?>
<?php endif; ?>
</p>
</div>



</form>