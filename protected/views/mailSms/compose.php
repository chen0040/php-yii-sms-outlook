<?php 
$user=Yii::app()->accountMgr->getAccount(); 
Yii::app()->accountMgr->applyLanguage();
?>
<?php
if(!isset($message_body))
{
	$message_body='';
}
if(!isset($recipients))
{
	$recipients='';
}
if(!isset($send_time))
{
	$send_time=date('Y-m-d H:i:s');
}
if(!isset($recipient_names))
{
	$recipient_names='';
}
?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="<?php echo $user->header_data_theme(); ?>">
		<a href="#" data-role="button" data-icon="grid"><?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?></a>
		<h1><?php echo Yii::t('translation', 'Compose a SMS to send'); ?></h1>
		<a href="<?php echo Yii::app()->createUrl('site/logout', array('url'=>'site/index')); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Logout'); ?></a>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('mailSms/compose', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false">
		
		<ul data-role="listview" data-inset="true">
			<li data-role="fieldcontain">
				<label for="recipient_names"><?php echo Yii::t('translation', 'To'); ?>:</label>
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

		
		<input type="submit" value="<?php echo Yii::t('translation', 'Send'); ?>" id="Send" name="Send" onclick="return validateBeforeSend();" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Save a Draft'); ?>" id="Save" name="Save" onclick="return validateBeforeSave();" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" name="Cancel" id="Cancel" data-icon="back" data-inline="true" class="cancel-btn" />

		<script type="text/javascript">
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
	
	<div data-role="footer" data-theme="<?php echo $user->header_data_theme(); ?>">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>

