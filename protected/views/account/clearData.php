<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Mass Delete'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitClearData', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$model->id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td>
		<label for="data_type" id="dataTypeLabel" name="dataTypeLabel"><?php echo Yii::t('translation', 'Type of Data to Mass Delete'); ?></label>		
		</td>
		</tr>
		
		<tr>
		<td>
		
			<select name="data_type" id="data_type" data-mini="true">
			   <option value="1" selected="selected"><?php echo Yii::t('translation', 'Outbox'); ?> <?php echo Yii::t('translation', 'Mails'); ?></option>
			   <option value="2" ><?php echo Yii::t('translation', 'Sent'); ?> <?php echo Yii::t('translation', 'Mails'); ?></option>
			   <option value="3" ><?php echo Yii::t('translation', 'Draft'); ?> <?php echo Yii::t('translation', 'Mails'); ?></option>
			   <option value="4" ><?php echo Yii::t('translation', 'Trash'); ?> <?php echo Yii::t('translation', 'Mails'); ?></option>
			   <option value="5" ><?php echo Yii::t('translation', 'Contacts'); ?></option>
			   <option value="6" ><?php echo Yii::t('translation', 'Groups'); ?></option>
			   <option value="7" ><?php echo Yii::t('translation', 'Tasks'); ?></option>
			</select> 

		</td>
		</tr>
		
		<tr>
			<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Mass Delete'); ?>" data-inline="true"/></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>