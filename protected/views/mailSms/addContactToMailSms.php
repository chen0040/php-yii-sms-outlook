<?php 
$user=Yii::app()->accountMgr->getAccount(); 
Yii::app()->accountMgr->applyLanguage();
?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
if(!isset($id))
{
	$id=-1;
}
?>

<?php if(isset($user)): ?>
<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl($this->getId().'/'.$this->getAction()->getId(), array('url'=>$url, 'field_id'=>$field_id, 'id'=>$id)); ?>" data-ajax="false">
<input type="hidden" name="recipients" id="recipients" value="<?php echo $recipients; ?>" />
<input type="hidden" name="send_time" id="send_time" value="<?php echo $send_time; ?>" />
<input type="hidden" name="message_body" id="message_body" value="<?php echo $message_body; ?>" />
<input type="hidden" name="addContactId" id="addContactId" value="" />			
<?php $contacts=Contact::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Contacts').': '.$username; ?>
			
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Please click any contact below to have the contact added to the SMS'); ?>
		<a href="#" onclick="cancelAddContactToMailSms(); return false;" data-icon="back" data-role="button" data-inline="true" class="cancel-btn">
		<?php echo Yii::t('translation', 'Cancel'); ?>
		</a>
		</li>
		
		<?php foreach($contacts as $contact): ?>			
			<?php if(!$model->hasContact($contact)): ?>
			<li>
			<a href="#" onclick="addContactToMailSms(<?php echo $contact->id; ?>); return false;"><?php echo $contact->first_name.' '.$contact->last_name; ?></a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</form>
<script type="text/javascript">
function addContactToMailSms(contact_id)
{	
	$("#addContactId").val(contact_id);
	$("#target-form").submit();
}
function cancelAddContactToMailSms()
{
	$("#addContactId").val('');
	$("#target-form").submit();
}
</script>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>


