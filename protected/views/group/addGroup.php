<?php $create_time=date('l jS \of F Y h:i:s A'); ?>
<?php 
Yii::app()->accountMgr->applyLanguage(); 
$groupname='';
$org_name='';
$description='';
if(isset($model))
{
	$groupname=$model->groupname;
	$org_name=$model->org_name;
	$description=$model->description;
}
if(!isset($groupname_error))
{
	$groupname_error='';
}
$user=Yii::app()->accountMgr->getAccount();
?>
<div data-role="page" id="target-dialog">
	<div data-role="header" data-theme="<?php echo $user->header_data_theme(); ?>">
		<a href="#" data-role="button" data-icon="grid"><?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?></a>
		<h1><?php echo Yii::t('translation', 'Create a Group'); ?></h1>
		<a href="<?php echo Yii::app()->createUrl('site/logout', array('url'=>'site/index')); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Logout'); ?></a>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl('group/addGroup', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false" enctype="multipart/form-data">

		<ul data-role="listview" data-inset="true">
			
			<li data-role="fieldcontain">
				<label for="groupImg"><?php echo Yii::t('translation', 'Image to Upload (Extension should be *.png)'); ?></label>
				<input type="file" name="groupImg" id="groupImg" /> 
			</li>
			
			<li data-role="fieldcontain">
				<label for="groupname"><?php echo Yii::t('translation', 'Name'); ?>*</label>
				<input type="text" name="groupname" id="groupname" value="<?php echo $groupname; ?>" />
				<label style="color:red"><?php echo $groupname_error; ?></label>
			</li>
			
			<li data-role="fieldcontain">
				<label for="org_name"><?php echo Yii::t('translation', 'Org'); ?></label>
				<input type="text" name="org_name" id="org_name" value="<?php echo $org_name; ?>" />
			</li>
			
			<li data-role="fieldcontain">
				<label for="description"><?php echo Yii::t('translation', 'Description'); ?></label>
				<input type="text" name="description" id="description" value="<?php echo $description; ?>" />
			</li>
			
		</ul>
		
		<input type="submit" value="<?php echo Yii::t('translation', 'Add Group'); ?>" id="AddGroup" name="AddGroup" data-inline="true" data-icon="check" onclick="return validateBeforeSend();" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" id="Cancel" name="Cancel" data-inline="true" data-icon="back" />
		
		<script type="text/javascript">
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


