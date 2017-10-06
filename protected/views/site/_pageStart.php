<?php
$data_theme='a'; 
if(isset($user))
{
	$data_theme=$user->header_data_theme();
}
Yii::app()->accountMgr->applyLanguage();
?>
<div data-role="page" id="home" data-theme="d" class="mailbox">

<div data-role="header" data-dividertheme="<?php echo $data_theme; ?>" data-theme="<?php echo $data_theme; ?>">
	<h1><?php echo Yii::t('translation', Yii::app()->name); ?></h1>
	<?php if(!isset($user)): ?>
	<a href="<?php echo Yii::app()->createUrl('account/login', array('url'=>'site/index')); ?>" data-role="button" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Login'); ?></a>
	<?php else: ?>
	<?php if(isset($url)): ?>
		<?php if(isset($field_id)): ?>
			<?php if(isset($sub_field_id)): ?>
				<a href="<?php echo Yii::app()->createUrl($url, array('field_id'=>$field_id, 'sub_field_id'=>$sub_field_id)); ?>" data-role="button" data-icon="back"><?php echo Yii::t('translation', 'Back'); ?></a>
			<?php else: ?>
				<a href="<?php echo Yii::app()->createUrl($url, array('field_id'=>$field_id)); ?>" data-role="button" data-icon="back"><?php echo Yii::t('translation', 'Back'); ?></a>
			<?php endif; ?>
		<?php else: ?>
			<a href="<?php echo Yii::app()->createUrl($url); ?>" data-role="button" data-icon="back"><?php echo Yii::t('translation', 'Back'); ?></a>
		<?php endif; ?>
	<?php else: ?>
		<a href="#" data-role="button" data-icon="grid"><?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?></a>
	<?php endif; ?>
	
	<a href="<?php echo Yii::app()->createUrl('site/logout', array('url'=>'site/index')); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Logout'); ?></a>
	<?php endif; ?>
	
	<?php if(!isset($user)): ?>
	<a href="<?php echo Yii::app()->createUrl('account/signup', array('url'=>'site/index')); ?>" data-role="button" data-rel="dialog" data-transition="pop"><?php echo Yii::t('translation', 'Signup'); ?></a>
	<?php endif; ?>
</div><!-- /header -->

<div data-role="content" style="color:#3366ff">

