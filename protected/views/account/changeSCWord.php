<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Change Server Client Password'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitChangeSCWord', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$model->id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td>
		<div id="passwordDiv" data-role="fieldcontain">
			<label for="password" id="passwordLabel" name="passwordLabel"><?php echo Yii::t('translation','Password'); ?>*</label>		
			<input id="password" name="password" type="password" value="<?php echo $model->getSecretPhase(); ?>"/>
		</div>
		<div id="passwordRepeatDiv" data-role="fieldcontain">
			<label for="passwordRepeat" id="passwordRepeatLabel" name="passwordRepeatLabel"><?php echo Yii::t('translation', 'Password Repeat'); ?>*</label>		
			<input id="passwordRepeat" name="passwordRepeat" type="password" value="<?php echo $model->getSecretPhase(); ?>" />
		</div>
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
			<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Change'); ?>" data-inline="true"/></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>