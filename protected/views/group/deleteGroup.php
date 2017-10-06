<!-- Start of third page: #popup -->
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1>Delete a Group</h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
		<table width="100%">
		<tr>
		<td>
		<div>
			Do you want to delete Group <?php echo $group->groupname; ?>?

		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl('group/submitDeleteGroup', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$group->id)); ?>" data-icon="check" data-role="button" data-inline="true">Delete Group</a></td>
		</tr>
		</table>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><?php echo Yii::app()->name; ?>: <?php echo Yii::t('translation', 'Please enter the details of the group to be added'); ?></h4>
	</div><!-- /footer -->
</div>