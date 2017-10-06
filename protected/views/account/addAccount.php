<?php Yii::app()->accountMgr->applyLanguage(); ?>
<?php
$dd=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y")+1);
$expiry_date=date('Y-m-d H:i:s', $dd);
?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Create Account'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitAddAccount', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td>
		<div id="passwordDiv" data-role="fieldcontain">
			<label for="username" id="usernameLabel" name="usernameLabel"><?php echo Yii::t('translation', 'Username'); ?>*</label>		
			<input id="username" name="username" type="text" />
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
			<input id="expiryDate" name="expiryDate" type="text" value="<?php echo $expiry_date; ?>" />
		</div>
		<div id="creditDiv" data-role="fieldcontain">
			<label for="credit" id="creditLabel" name="creditLabel"><?php echo Yii::t('translation', 'Credit'); ?></label>		
			<input id="credit" name="credit" type="text" value="<?php echo Account::DEFAULT_INITIAL_CREDIT; ?>" />
		</div>
		<div id="secretDiv" data-role="fieldcontain">
			<label for="secret" id="secretLabel" name="secretLabel"><?php echo Yii::t('translation', 'Secret Pass'); ?>*</label>		
			<input id="secret" name="secret" type="password" />
		</div>
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
			<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Add Account'); ?>" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>