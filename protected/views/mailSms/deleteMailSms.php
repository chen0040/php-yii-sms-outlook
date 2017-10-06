<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Delete a SMS'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	
		<table width="100%">
		<tr>
		<td>
		<div>
			<?php echo Yii::t('translation', 'Do you want to delete SMS'); ?>?
		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl('mailSms/submitDeleteMailSms', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$current_mail->id)); ?>" data-icon="check" data-role="button" data-inline="true" class="cancel-btn">Delete</a></td>
		</tr>
		</table>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>