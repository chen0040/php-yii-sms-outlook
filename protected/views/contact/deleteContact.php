<!-- Start of third page: #popup -->
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1>Delete a Contact</h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	
		<table width="100%">
		<tr>
		<td>
		<div>
			Do you want to delete Contact <?php echo $contact->first_name.' '.$contact->last_name; ?>?
		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl('contact/submitDeleteContact', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$contact->id)); ?>" data-icon="check" data-role="button" data-inline="true">OK</a></td>
		</tr>
		</table>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><?php echo Yii::app()->name; ?>: <?php echo Yii::t('translation', 'Please confirm whether to delete the contact'); ?></h4>
	</div><!-- /footer -->
</div>