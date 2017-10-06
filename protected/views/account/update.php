<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1>Update Account</h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitUpdate', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$model->id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="2">
		<div id="usernameDiv" data-role="fieldcontain">
			<label for="username" id="usernameLabel" name="usernameLabel"><?php echo Yii::t('translation', 'Username'); ?>*</label>		
			<input id="username" name="username" type="text" value="<?php echo $model->username; ?>" />
		</div>
		<div id="passwordDiv" data-role="fieldcontain">
			<label for="password" id="passwordLabel" name="passwordLabel"><?php echo Yii::t('translation', 'Password'); ?>*</label>		
			<input id="password" name="password" type="password" />
		</div>
		<div id="passwordRepeatDiv" data-role="fieldcontain">
			<label for="passwordRepeat" id="passwordRepeatLabel" name="passwordRepeatLabel"><?php echo Yii::t('translation', 'Password Repeat'); ?>*</label>		
			<input id="passwordRepeat" name="passwordRepeat" type="password" />
		</div>
		<div id="expiryDateDiv" data-role="fieldcontain">
			<label for="expiryDate" id="expiryDateLabel" name="expiryDateLabel"><?php echo Yii::t('translation', 'Expiry Date'); ?></label>		
			<input id="expiryDate" name="expiryDate" type="text" value="<?php echo $model->getExpiryDate(); ?>" />
		</div>
		<div id="creditDiv" data-role="fieldcontain">
			<label for="credit" id="creditLabel" name="creditLabel"><?php echo Yii::t('translation', 'Credit'); ?></label>		
			<input id="credit" name="credit" type="text" value="<?php echo $model->getCredit(); ?>" />
		</div>
		<div id="secretDiv" data-role="fieldcontain">
			<label for="secret" id="secretLabel" name="secretLabel"><?php echo Yii::t('translation', 'Secret Pass'); ?>*</label>		
			<input id="secret" name="secret" type="password" value="<?php echo $model->getSecretPhase(); ?>" />
		</div>
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
			<td style="text-align:center"><input type="submit" name="UpdateAccount" value="<?php echo Yii::t('translation', 'Update Account'); ?>" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-icon="check" /></td>
			<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl('account/submitDeleteAccount', array('field_id'=>$field_id, 'url'=>$url, 'id'=>$model->id)); ?>" data-icon="delete" data-role="button" class="cancel-btn" data-inline="true"><?php echo Yii::t('translation', 'Delete Account'); ?></a></td>
		</tr>
		<tr>
			<?php if($model->isSuspended()): ?>
			<td style="text-align:center">
			<input type="submit" name="ActivateAccount" value="<?php echo Yii::t('translation', 'Activate'); ?>" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-icon="check" />
			</td>
			<?php else: ?>
			<td style="text-align:center">
			<input type="submit" name="SuspendAccount" value="<?php echo Yii::t('translation', 'Suspend'); ?>" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-icon="check" />
			</td>
			<?php endif; ?>
			
			<td style="text-align:center"><input type="submit" name="ClearFailedLogins" value="<?php echo Yii::t('translation', 'Reset Login Attempts'); ?>" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-icon="check" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<?php if($model->isSuspended()): ?>
		<h4><?php echo Yii::t('translation', 'This account is suspended'); ?></h4>
		<?php else: ?>
		<h4><?php echo Yii::t('translation', 'This account is active'); ?></h4>
		<?php endif; ?>
	</div><!-- /footer -->
</div>