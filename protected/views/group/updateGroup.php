<?php 
Yii::app()->accountMgr->applyLanguage(); 
if(!isset($groupname_error))
{
	$groupname_error='';
}
$user=Yii::app()->accountMgr->getAccount();
?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="<?php echo $user->header_data_theme(); ?>">
		<a href="#" data-role="button" data-icon="grid"><?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?></a>
		<h1><?php echo Yii::t('translation', 'View a Group'); ?></h1>
		<a href="<?php echo Yii::app()->createUrl('site/logout', array('url'=>'site/index')); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Logout'); ?></a>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('group/updateGroup', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$group->id)); ?>" data-ajax="false" enctype="multipart/form-data">

		<ul data-role="listview" data-inset="true">
			
			<li style="height:140px">
			<?php if(isset($group)): ?>
			<?php echo CHtml::image($group->getImagePathIfFileExists(), 'Group', array('style'=>'padding:10px;width:120px;height:140px;')); ?> 
			<?php endif; ?>
			</li>
			
			<li>
				<label for="groupImg"><?php echo Yii::t('translation', 'Image to Upload (Extension should be *.png)'); ?>:</label>
				<input type="file" name="groupImg" id="groupImg"> 
			</li>
			
			<li data-role="fieldcontain">
				<label for="groupname"><?php echo Yii::t('translation', 'Name'); ?>*</label>
				<input type="text" name="groupname" id="groupname" value="<?php echo $group->groupname; ?>" />
				<label style="color:red"><?php echo $groupname_error; ?></label>
			</li>
			<li data-role="fieldcontain">
				<label for="org_name"><?php echo Yii::t('translation', 'Org'); ?>*</label>
				<input type="text" name="org_name" id="org_name" value="<?php echo $group->org_name; ?>" />
			</li>
			<li data-role="fieldcontain">
				<label for="description"><?php echo Yii::t('translation', 'Description'); ?>*</label>
				<input type="text" name="description" id="description" value="<?php echo $group->description; ?>"  />
			</li>
			
		</ul>
		
		<input type="submit" value="<?php echo Yii::t('translation', 'Update'); ?>" id="UpdateGroup" name="UpdateGroup" data-inline="true" onclick="return validateBeforeSend();" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Delete'); ?>" id="Delete" name="Delete" data-inline="true" onclick="return confirmDelete();" data-icon="delete" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" id="Cancel" name="Cancel" data-inline="true" data-icon="back" />

		<script type="text/javascript">
		function confirmDelete()
		{
			if(confirm("<?php echo Yii::t('translation', 'Do you want to delete the group').'?'; ?>"))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		function validateBeforeSend()
		{
			var groupname_val=$("#groupname").val();
			if(groupname_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Name cannot be empty'); ?>");
				return false;
			}
			return true;
		}
		</script>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="<?php echo $user->header_data_theme(); ?>">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>

