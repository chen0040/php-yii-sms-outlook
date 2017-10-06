<?php
Yii::app()->accountMgr->applyLanguage();
?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Change Language'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/changeLanguage', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$model->id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="2">
		
		<div id="themeDiv" data-role="fieldcontain">
			<label for="language"><?php echo Yii::t('translation', 'Language'); ?>*</label>		
			<select name="language" id="language" data-mini="true">
			   <option value="en_us" <?php if($model->getLanguage()=='en_us') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'English'); ?></option>
			   <option value="zh_cn" <?php if($model->getLanguage()=='zh_cn') echo 'selected="selected"'; ?> ><?php echo Yii::t('translation', 'Chinese'); ?></option>
			 
			</select> 
		</div>
		
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		</td>
		</tr>
		
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl($url, array('field_id'=>$field_id)); ?>" data-icon="delete" data-role="button" data-inline="true" data-icon="back">
		<?php echo Yii::t('translation', 'Cancel'); ?>
		</a></td>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Change'); ?>" name="Change" id="Change" data-inline="true"/></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>