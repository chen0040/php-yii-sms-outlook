<?php $create_time=date('l jS \of F Y h:i:s A'); ?>
<?php Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="dialog" id="target-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Create a Group'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl('group/submitAddGroup', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false" enctype="multipart/form-data">
		<table width="100%">
		<tr>
		<td>
		<div>
			<ul data-role="listview" data-inset="true">
				
				<li data-role="fieldcontain">
					<label for="groupImg"><?php echo Yii::t('translation', 'Image to Upload (Extension should be *.png)'); ?></label>
					<input type="file" name="groupImg" id="groupImg" /> 
				</li>
				
				<li data-role="fieldcontain">
					<label for="groupname"><?php echo Yii::t('translation', 'Name'); ?>*</label>
					<input type="text" name="groupname" id="groupname" value="" />
				</li>
				
				<li data-role="fieldcontain">
					<label for="org_name"><?php echo Yii::t('translation', 'Org'); ?>*</label>
					<input type="text" name="org_name" id="org_name" value="" />
				</li>
				
				<li data-role="fieldcontain">
					<label for="description"><?php echo Yii::t('translation', 'Description'); ?>*</label>
					<input type="text" name="description" id="description" value="" />
				</li>
				
			</ul>
		</div>
		</td>
		</tr>
		<tr>
		<td style="text-align:center"><input type="submit" value="<?php echo Yii::t('translation', 'Add Group'); ?>" id="AddGroup" name="AddGroup" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>

<script type="text/javascript">
$.mobile.changePage('#target-dialog','pop',false,true);
</script>

