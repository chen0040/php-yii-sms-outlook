<!-- Start of third page: #popup -->
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="<?php echo $model->header_data_theme(); ?>">
		<a href="<?php echo Yii::app()->createUrl($url, array('field_id'=>$field_id)); ?>" data-role="button"><?php echo Yii::t('translation', 'Back'); ?></a>
		<h1>Statistics Chart</h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $model->data_theme(); ?>">	
	
		<table width="100%">
		<tr>
		<td>
		<div>
			<?php echo CHtml::image(Yii::app()->createUrl('account/showChart'), ''); ?>
		</div>
		</td>
		</tr>

		</table>
	
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="<?php echo $model->header_data_theme(); ?>">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>