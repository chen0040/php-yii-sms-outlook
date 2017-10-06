<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user, 'url'=>$url, 'field_id'=>$field_id));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
?>

<?php if(isset($user)): ?>
<?php $groups=Group::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'SMS Templates').': '.$username; ?></li>
		<li data-role="list-divider">
			<a href="<?php echo Yii::app()->createUrl('mailSms/addMailSmsTemplate', array('parent_url'=>'mailSms/indexMailSmsTemplates', 'url'=>$url, 'field_id'=>$field_id)); ?>" data-icon="plus" data-mini="true" data-rel="dialog" data-transition="pop" data-role="button" data-inline="true">
			<?php echo Yii::t('translation', 'Add'); ?></a>
		</li>
		
		<?php $mails=$user->getMailSmsTemplates(); ?>
		
		<?php foreach($mails as $mail): ?>
		<li>
			<a href="<?php echo Yii::app()->createUrl('mailSms/updateMailSmsTemplate', array('parent_url'=>'mailSms/indexMailSmsTemplates', 'url'=>$url, 'field_id'=>$field_id, 'id'=>$mail->id)); ?>" data-rel="dialog" data-transition="pop">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mail.png', 'Message', array('class'=>'ui-li-icon')); ?> 
			<p><strong><?php echo $mail->getTemplateTitle(); ?></strong></p>
			<p><?php echo $mail->message_body; ?></p>
			<p class="ui-li-aside"><strong><?php echo $mail->getUpdateTime(); ?></strong></p>
			</a>
		</li>
		<?php endforeach; ?>
		

	</ul>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>
