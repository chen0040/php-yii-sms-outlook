<?php 
$username=$model->username;
if(isset($model->first_name))
{
	$username=$model->first_name.' '.$model->last_name;
}
$data_divider_theme=$model->data_divider_theme(); 

Yii::app()->accountMgr->applyLanguage();
?>

<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Settings').': '.$username; ?></li>
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Accounts').': '.$username; ?></li>
	<?php if(!$model->isAdmin()): ?>
	<li>
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/acc.png', 'Remaining Days', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Expiry Date').': '.$model->getExpiryDate(); ?>
	<span class="ui-li-count"><?php echo Yii::t('translation', 'Expired after ').$model->getRemainingDays().' '.Yii::t('translation', 'days'); ?></span>
	</li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/transferCredit', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index')); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/acc.png', 'Transfer Credit', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Credit'); ?>
	<span class="ui-li-count"><?php echo $model->getCredit(); ?></span>
	</a>
	</li>
	<?php endif; ?>
	<?php if($model->isAdmin()): ?>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/addAccount', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index')); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/acc.png', 'Add Account', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Account: Add'); ?>
	</a>
	</li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/index', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index')); ?>" >
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/accview.png', 'View Accounts', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Account: Manage'); ?>
	<span class="ui-li-count"><?php echo Account::model()->count(); ?></span>
	</a>
	</li>	
	<?php endif; ?>
	
	<?php if($model->isAdmin()): ?>
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Data').': '.$username; ?></li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/backup'); ?>" target="_blank" onclick="return confirmDownloadSqlData();">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/accview.png', 'Data Backup', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Data: Backup'); ?>
	</a>
	</li>
	<?php endif; ?>
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Security').': '.$username; ?></li>
	<?php if($model->isAdmin()): ?>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/changeSCWord', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index', 'id'=>$model->id)); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/password.png', 'Change Server-Client Password', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Change Server-Client Password'); ?>
	</a>
	</li>
	<?php endif; ?>
	
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/changePassword', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index', 'id'=>$model->id)); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/password.png', 'Change Password', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Change Password'); ?>
	</a>
	</li>
	
	
	
	<li data-role="list-divider"><?php echo Yii::t('translation', 'User Interface').': '.$username; ?></li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/changeTheme', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index', 'id'=>$model->id)); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/themes.png', 'Change Theme', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Change Theme'); ?> <span class="ui-li-count"><?php echo $model->getThemeName(); ?></span>
	</a>
	</li>
	<li>
	<a href="<?php echo Yii::app()->createUrl('account/changeLanguage', array('field_id'=>SiteStateMachine::FIELD_SETTINGS, 'url'=>'site/index', 'id'=>$model->id)); ?>" data-rel="dialog" data-transition="pop">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/img/themes.png', 'Change Language', array('class'=>'ui-li-icon')); ?> <?php echo Yii::t('translation', 'Change Language'); ?> <span class="ui-li-count"><?php echo $model->getLanguageName(); ?></span>
	</a>
	</li>
	
	
	
</ul>

<script type="text/javascript">
function confirmDownloadSqlData()
{
	if(confirm("<?php echo Yii::t('translation', 'Do you want to download the Data Backup SQL Data').'?'; ?>"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
		
	