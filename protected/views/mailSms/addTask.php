<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Create a Task'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('mailSms/submitAddTask', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td>
		<div>
			<ul data-role="listview" data-inset="true">
				<li data-role="fieldcontain">
					<label for="task_status"><?php echo Yii::t('translation', 'Task Status'); ?>:</label>
					<select name="task_status" id="task_status" data-mini="true">
					   <option value="<?php echo MailSms::STATUS_TASK_ACTIVE; ?>" selected="selected"><?php echo Yii::t('translation', 'Active Task'); ?></option>
					   <option value="<?php echo MailSms::STATUS_TASK_COMPLETED; ?>" ><?php echo Yii::t('translation', 'Completed Task'); ?></option>
					   <option value="<?php echo MailSms::STATUS_TASK_INACTIVE; ?>" ><?php echo Yii::t('translation', 'Inactive Task'); ?></option>
					</select> 
				</li>
				<li data-role="fieldcontain">
					<label for="task_details"><?php echo Yii::t('translation', 'Task').' '.Yii::t('translation', 'Details'); ?>:</label>
					<textarea cols="40" rows="40" name="task_details" id="task_details"></textarea>
				</li>				
			</ul>
		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Add Task'); ?>" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>