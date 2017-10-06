<?php 
$user=Yii::app()->accountMgr->getAccount(); 
Yii::app()->accountMgr->applyLanguage();
?>
<div data-role="page" id="target-dialog">
	<div data-role="header" data-theme="<?php echo $user->header_data_theme(); ?>">
		<h1><?php echo Yii::t('translation', 'Compose a SMS Template'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl('mailSms/addMailSmsTemplate', array('url'=>$url, 'field_id'=>$field_id, 'parent_url'=>$parent_url)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="3">
		<div>
			<ul data-role="listview" data-inset="true">
				
				<li data-role="fieldcontain">
					<label for="template_title"><?php echo Yii::t('translation', 'Template Title'); ?>:</label>
					<input type="text" name="template_title" id="template_title"></textarea>
				</li>
				
				<li data-role="fieldcontain">
					<label for="message_body"><?php echo Yii::t('translation', 'Message Body'); ?>:</label>
					<textarea cols="40" rows="40" name="message_body" id="message_body" class="mail_body"></textarea>
				</li>
			</ul>

		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Save'); ?>" id="Save" name="Save" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" /></td>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" name="Cancel" id="Cancel" data-icon="back" data-inline="true" class="cancel-btn" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="<?php echo $user->header_data_theme(); ?>">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>

