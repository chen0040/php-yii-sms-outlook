<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Change Theme'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitChangeTheme', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$model->id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="2">
		
		<div id="themeDiv" data-role="fieldcontain">
			<label for="theme" id="themeLabel" name="themeLabel"><?php echo Yii::t('translation', 'Theme'); ?>*</label>		
			<select name="theme" id="theme" data-mini="true">
			   <option value="a" <?php if($model->getTheme()=='a') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Black'); ?></option>
			   <option value="b" <?php if($model->getTheme()=='b') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Blue'); ?></option>
			   <option value="c" <?php if($model->getTheme()=='c') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Silver'); ?></option>
			   <option value="d" <?php if($model->getTheme()=='d') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Gray'); ?></option>
			   <option value="e" <?php if($model->getTheme()=='e') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Yellow'); ?></option>
			   <option value="f" <?php if($model->getTheme()=='f') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Green'); ?></option>
			</select> 
		</div>
		
		<div id="themeDiv" data-role="fieldcontain">
			<label for="themeHeader" id="themeHeaderLabel" name="themeHeaderLabel"><?php echo Yii::t('translation', 'Header Theme'); ?>*</label>		
			<select name="themeHeader" id="themeHeader" data-mini="true">
			   <option value="a" <?php if($model->header_data_theme()=='a') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Black'); ?></option>
			   <option value="b" <?php if($model->header_data_theme()=='b') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Blue'); ?></option>
			   <option value="c" <?php if($model->header_data_theme()=='c') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Silver'); ?></option>
			   <option value="d" <?php if($model->header_data_theme()=='d') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Gray'); ?></option>
			   <option value="e" <?php if($model->header_data_theme()=='e') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Yellow'); ?></option>
			   <option value="f" <?php if($model->header_data_theme()=='f') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Green'); ?></option>
			</select> 
		</div>
		
		
		
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl($url, array('field_id'=>$field_id)); ?>" data-icon="delete" data-role="button" data-inline="true" data-icon="back"><?php echo Yii::t('translation', 'Cancel'); ?></a></td>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Change'); ?>" data-inline="true"/></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>