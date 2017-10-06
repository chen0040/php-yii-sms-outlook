<?php 
$user=Yii::app()->accountMgr->getAccount(); 
$data_divider_theme=$user->header_data_theme();
if(!isset($send_time))
{
	$send_time=$mailSms->getSendTime();
}
if(!isset($recipient_names))
{
	$recipient_names=$mailSms->getFormattedRecipients();
}
if(!isset($recipients))
{
	$recipients=$mailSms->txt_field1;
}
if(!isset($message_body))
{
	$message_body=$mailSms->message_body;
}
Yii::app()->accountMgr->applyLanguage();
?>


<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="<?php echo $data_divider_theme; ?>">
		<h1><?php echo Yii::t('translation', 'Current SMS'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('mailSms/updateMailSms', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$mailSms->id)); ?>" data-ajax="false">

			<ul data-role="listview" data-inset="true">
				<li data-role="fieldcontain">
					<label for="recipients"><?php echo Yii::t('translation', 'Recipients'); ?>:</label>
					<input type="text" name="recipient_names" id="recipient_names" value="<?php echo $recipient_names; ?>"  class="mail_rec" />
					<input type="hidden" name="recipients" id="recipients" value="<?php echo $recipients; ?>" />
				</li>
				<li>
					<input type="submit" value="<?php echo Yii::t('translation', 'Add Contact'); ?>" id="addContact" name="addContact" data-inline="true" data-icon="plus"/>
					<input type="submit" value="<?php echo Yii::t('translation', 'Add Group'); ?>" id="addGroup" name="addGroup" data-inline="true" data-icon="plus"/>
					<input type="submit" value="<?php echo Yii::t('translation', 'Remove Last'); ?>" id="removeLastRep" name="removeLastRep" data-inline="true" data-icon="minus"/>
				</li>
				<li data-role="fieldcontain">
					<label for="send_time"><?php echo Yii::t('translation', 'Send On'); ?>:</label>
					<input type="text" name="send_time" id="send_time" value="<?php echo $send_time; ?>" />
				</li>
				<li data-role="fieldcontain">
					<label for="message_body"><?php echo Yii::t('translation', 'Message Body'); ?>:</label>
				<textarea cols="40" rows="40" name="message_body" id="message_body" class="mail_body"><?php echo $message_body; ?></textarea>
				</li>				
			</ul>
		
		<input type="submit" id="Send" name="Send" value="<?php echo Yii::t('translation', 'Send'); ?>" onclick="return validateBeforeSend();" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" id="Save" name="Save" value="<?php echo Yii::t('translation', 'Save a Draft'); ?>" onclick="return validateBeforeSave();" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<?php if($mailSms->status!=MailSms::STATUS_TRASH): ?>
		<input type="submit" id="Trash" name="Trash" value="<?php echo Yii::t('translation', 'Trash'); ?>" data-inline="true" data-icon="delete" class="cancel-btn" onclick="return confirmTrash();" />
		<?php endif; ?>
		<input type="submit" id="Delete" name="Delete" data-icon="delete" data-inline="true" value="<?php echo Yii::t('translation', 'Delete'); ?>" onclick="return confirmDelete();" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" name="Cancel" id="Cancel" data-icon="back" data-inline="true" class="cancel-btn" />
		
		<script type="text/javascript">
		function confirmDelete()
		{
			if(confirm("<?php echo Yii::t('translation', 'Do you want to delete the message').'?'; ?>"))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		function confirmTrash()
		{
			if(confirm("<?php echo Yii::t('translation', 'Do you want to trash the message').'?'; ?>"))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		function validateBeforeSave()
		{
			var message_body_val=$("#message_body").val();
			if(message_body_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Message Body cannot be empty'); ?>");
				return false;
			}
			return true;
		}
		function validateBeforeSend()
		{
			var recipients_val=$("#recipients").val();
			if(recipients_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Recipients cannot be empty'); ?>");
				return false;
			}
			var message_body_val=$("#message_body").val();
			if(message_body_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Message Body cannot be empty'); ?>");
				return false;
			}
			return true;
		}
		</script>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer"  data-theme="<?php echo $data_divider_theme; ?>">
		<h4><?php echo Yii::t('translation', 'Please enter the details of the SMS before sending or saving the SMS'); ?></h4>
	</div><!-- /footer -->
</div>