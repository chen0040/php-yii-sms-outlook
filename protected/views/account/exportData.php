<?php $user=Yii::app()->accountMgr->getAccount(); ?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user, 'url'=>$url, 'field_id'=>$field_id));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
?>

<?php if(isset($user)): ?>
<?php $accounts=Account::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Export Data').': '.$username; ?></li>
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Export Data is only available for web-based browser on personal computer'); ?></li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Please click the link below to download the data'); ?>
		</li>
		
		<li>
		<a href="<?php echo Yii::app()->createUrl('account/exportContacts', array('id'=>$user->id)); ?>" onclick="return confirmDownload();" target="_blank">
		<?php echo Yii::t('translation', 'Export').' '.Yii::t('translation', 'Contacts'); ?></a>
		</li>
		
		<li>
		<a href="<?php echo Yii::app()->createUrl('account/exportMessages', array('id'=>$user->id, 'status'=>MailSms::STATUS_OUTBOX)); ?>" onclick="return confirmDownload();" target="_blank">
		<?php echo Yii::t('translation', 'Export').' '.Yii::t('translation', 'Outbox').' '.Yii::t('translation', 'Messages'); ?></a>
		</li>
		
		<li>
		<a href="<?php echo Yii::app()->createUrl('account/exportMessages', array('id'=>$user->id, 'status'=>MailSms::STATUS_SENT)); ?>" onclick="return confirmDownload();" target="_blank">
		<?php echo Yii::t('translation', 'Export').' '.Yii::t('translation', 'Sent').' '.Yii::t('translation', 'Messages'); ?></a>
		</li>
		
		<li>
		<a href="<?php echo Yii::app()->createUrl('account/exportMessages', array('id'=>$user->id, 'status'=>MailSms::STATUS_DRAFT)); ?>" onclick="return confirmDownload();" target="_blank">
		<?php echo Yii::t('translation', 'Export').' '.Yii::t('translation', 'Draft').' '.Yii::t('translation','Messages'); ?></a>
		</li>
		
		<li>
		<a href="<?php echo Yii::app()->createUrl('account/exportMessages', array('id'=>$user->id, 'status'=>MailSms::STATUS_TRASH)); ?>" onclick="return confirmDownload();" target="_blank">
		<?php echo Yii::t('translation', 'Export').' '.Yii::t('translation', 'Trash').' '.Yii::t('translation', 'Messages'); ?></a>
		</li>
		
	</ul>
	<script type="text/javascript">
	function confirmDownload()
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
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>


