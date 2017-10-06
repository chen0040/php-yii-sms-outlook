<?php 
$user=Yii::app()->accountMgr->getAccount(); 
Yii::app()->accountMgr->applyLanguage(); 
?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user, 'url'=>$url, 'field_id'=>$field_id));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
?>

<?php if(isset($user)): ?>
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitImportData', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$user->id)); ?>" data-ajax="false" enctype="multipart/form-data">
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Import Data').': '.$username; ?></li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Step 0: Prepare and Validate your files to upload'); ?>
		</li>
		
		<li>
		<p><b><?php echo Yii::t('translation', 'Message').' '.Yii::t('translation', 'File Format'); ?>:</b></p>
		<p><?php echo Yii::t('translation', 'The format of a single line in the CSV File of Contacts should be').': '.Yii::t('translation', '[first_name], [phone], [group_name], [DOB], [last_name], [email], [organization], [ethnic_group], [gender]'); ?></p>
		</li>
		
		<li>
		<p><b><?php echo Yii::t('translation', 'Contact').' '.Yii::t('translation', 'File Format'); ?>:</b></p>
		
		<p>
		<?php echo Yii::t('translation', 'The format of a single line in the CSV File of Messages should be').': '.Yii::t('translation', '[send_time], [message_content], [groups]'); ?><br />
		<?php echo Yii::t('translation', 'The [send_time] should be: yyyy-MM-dd HH:mm:ss (e.g., 2012-08-12 11:45:00)'); ?><br />
		<?php echo Yii::t('translation', 'The [groups] should be: group names separated by comma (e.g., Group1, Group2)'); ?>
		</p>
		</li>
		
		<li>
		<?php echo Yii::t('translation', 'Sample files can be download from here').':'; ?>
		<div data-role="controlgroup" data-type="horizontal" data-mini="true">
			<a href="<?php echo Yii::app()->baseUrl.'/samples/sample_contacts.csv'; ?>" onclick="return confirmDownloadSamples();" data-role="button" data-icon="grid" target="_blank">
			<?php echo Yii::t('translation', 'Sample').' '.Yii::t('translation', 'Contacts'); ?></a>
			<a href="<?php echo Yii::app()->baseUrl.'/samples/sample_messages.csv'; ?>" onclick="return confirmDownloadSamples();" data-role="button" data-icon="grid" target="_blank">
			<?php echo Yii::t('translation', 'Sample').' '.Yii::t('translation', 'Messages'); ?></a>
		</div>
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Step 1: Drop your Contacts CSV file to upload'); ?>
		</li>
		
	
		
		<li>
		<input type="file" name="importContacts" id="importContacts"> 
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Step 2: Drop your Messages CSV file to upload'); ?>
		</li>
		
	
		
		<li>
		<input type="file" name="importMessages" id="importMessages"> 
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Step 3: Configure where the uploaded SMS goes after uploading'); ?>
		</li>
		
		<li>
			<div id="sms_toDiv" data-role="fieldcontain">
				<label for="sms_to" id="sms_toLabel" name="sms_toLabel"><?php echo Yii::t('translation', 'Store SMS by').':'; ?></label>		
				<select name="sms_to" id="sms_to" data-mini="true">
				   <option value="<?php echo MailSms::STATUS_DRAFT; ?>" selected="selected"><?php echo Yii::t('translation', 'Save to the Draft'); ?></option>
				   <option value="<?php echo MailSms::STATUS_OUTBOX; ?>" ><?php echo Yii::t('translation', 'Directly to the Outbox'); ?></option>
				</select> 
			</div>
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Step 4: Click to complete upload'); ?>
		</li>
		
		<li>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Upload'); ?>" data-inline="true"/></td>
		</li>
	
	</ul>
	
	<script type="text/javascript">
	function confirmDownloadSamples()
	{
		if(confirm("<?php echo Yii::t('translation', 'Do you want to download the data').'?'; ?>"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	</script>
	</form>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>


