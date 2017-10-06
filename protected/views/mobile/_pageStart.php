<?php
$data_theme='a'; 
if(isset($user))
{
	$data_theme=$user->header_data_theme();
}
Yii::app()->accountMgr->applyLanguage();
?>
<div data-role="page" id="home" data-theme="d">

<div data-role="header" data-dividertheme="<?php echo $data_theme; ?>" data-theme="<?php echo $data_theme; ?>">
	<h1><?php echo Yii::t('translation', Yii::app()->name); ?></h1>
	<?php if(!isset($user)): ?>
		
		<a href="<?php echo Yii::app()->createUrl('account/login', array('url'=>'mobile/index')); ?>" data-role="button" data-rel="dialog" data-transition="pop">
			<?php echo Yii::t('translation', 'Login'); ?>
		</a>
		
		<a href="<?php echo Yii::app()->createUrl('account/signup', array('url'=>'mobile/index')); ?>" data-role="button" data-rel="dialog" data-transition="pop">
			<?php echo Yii::t('translation', 'Signup'); ?>
		
		</a>	
	<?php elseif($state_machine->stack_id == 0): ?>
		
		<a href="#" data-role="button" data-icon="grid">
			<?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?>
		</a>
		
		<a href="<?php echo Yii::app()->createUrl('mobile/logout', array('url'=>'mobile/index')); ?>" data-role="button" data-icon="delete">
			<?php echo Yii::t('translation', 'Logout'); ?>
		</a>
		
	<?php elseif($state_machine->stack_id > 0): ?>
		
		<a href="<?php echo Yii::app()->createUrl('mobile/index', array('url'=>'mobile/index', 'field_id'=>$state_machine->field_id, 'sub_field_id'=>$state_machine->sub_field_id, 'stack_id'=>($state_machine->stack_id-1))); ?>" data-role="button" data-icon="back">
			<?php echo Yii::t('translation', 'Back'); ?>
		</a>
		
		<a href="<?php echo Yii::app()->createUrl('mobile/logout', array('url'=>'mobile/index')); ?>" data-role="button" data-icon="delete">
			<?php echo Yii::t('translation', 'Logout'); ?>
		</a>
		
	<?php endif; ?>
</div><!-- /header -->

<div data-role="content" style="color:#3366ff">

