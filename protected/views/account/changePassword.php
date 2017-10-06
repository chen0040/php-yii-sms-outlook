<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="target-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Change Password'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitChangePassword', array('id'=>$model->id, 'url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="2">
		<div id="passwordDiv" data-role="fieldcontain">
			<label for="password" id="passwordLabel" name="passwordLabel"><?php echo Yii::t('translation', 'Password'); ?>*</label>		
			<input id="password" name="password" type="password" />
		</div>
		<div id="passwordRepeatDiv" data-role="fieldcontain">
			<label for="passwordRepeat" id="passwordRepeatLabel" name="passwordRepeatLabel"><?php echo Yii::t('translation', 'Password Repeat'); ?>*</label>		
			<input id="passwordRepeat" name="passwordRepeat" type="password" />
		</div>
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Change'); ?>" id="Change" name="Change" data-inline="true"/></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>