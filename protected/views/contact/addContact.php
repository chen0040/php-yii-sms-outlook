<?php
$user=Yii::app()->accountMgr->getAccount();
Yii::app()->accountMgr->applyLanguage(); 
if(!isset($error_first_name))
{
	$error_first_name='';
}
if(!isset($error_contact_number))
{
	$error_contact_number='';
}
if(!isset($error_last_name))
{
	$error_last_name='';
}
if(!isset($error_dob))
{
	$error_dob='';
}
if(!isset($error_email))
{
	$error_email='';
}
?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="<?php echo $user->header_data_theme(); ?>">
		<a href="#" data-role="button" data-icon="grid"><?php echo Yii::t('translation', 'Account').': '.$user->getUsername().' ('.$user->getCredit().')'; ?></a>
		<h1><?php echo Yii::t('translation', 'Create a Contact'); ?></h1>
		<a href="<?php echo Yii::app()->createUrl('site/logout', array('url'=>'site/index')); ?>" data-role="button" data-icon="delete"><?php echo Yii::t('translation', 'Logout'); ?></a>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="<?php echo $user->data_theme(); ?>">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('contact/addContact', array('url'=>$url, 'field_id'=>$field_id)); ?>" data-ajax="false" enctype="multipart/form-data">

			<ul data-role="listview" data-inset="true">				
				<li>
					<label for="contactImg"><?php echo Yii::t('translation', 'Image to Upload (Extension should be *.png)'); ?>:</label>
					<input type="file" name="contactImg" id="contactImg"> 
				</li>
				
				<li data-role="fieldcontain">
					<label for="first_name"><?php echo Yii::t('translation', 'First Name'); ?>*</label>
					<input type="text" name="first_name" id="first_name" value="<?php echo $model->getFirstName(); ?>" />
					<label style="color:red"><?php echo $error_first_name; ?></label>
				</li>
				<li data-role="fieldcontain">
					<label for="last_name"><?php echo Yii::t('translation', 'Last Name'); ?>*</label>
					<input type="text" name="last_name" id="last_name" value="<?php echo $model->getLastName(); ?>" />
					<label style="color:red"><?php echo $error_last_name; ?></label>
				</li>
				<li data-role="fieldcontain">
					<label for="dob"><?php echo Yii::t('translation', 'Date of Birth'); ?>*</label>
					<input type="text" name="dob" id="dob" value="<?php echo $model->getDOB(); ?>"  />
					<label style="color:red"><?php echo $error_dob; ?></label>
				</li>
				<li data-role="fieldcontain">
					<label for="contact_number"><?php echo Yii::t('translation', 'Contact Number'); ?>*</label>
					<input type="text" name="contact_number" id="contact_number" value="<?php echo $model->getContactNumber(); ?>"  />
					<label style="color:red"><?php echo $error_contact_number; ?></label>
				</li>
				<li data-role="fieldcontain">
					<label for="email"><?php echo Yii::t('translation', 'Email'); ?>*</label>
					<input type="text" name="email" id="email" value="<?php echo $model->getEmail(); ?>"  />
					<label style="color:red"><?php echo $error_email; ?></label>
				</li>
				<li data-role="fieldcontain">
					<label for="org"><?php echo Yii::t('translation', 'Org'); ?></label>
					<input type="text" name="org" id="org" value="<?php echo $model->getOrg(); ?>"  />
				</li>
				<li data-role="fieldcontain">
					<label for="ethnic_group"><?php echo Yii::t('translation', 'Ethnic Group'); ?></label>
					<input type="text" name="ethnic_group" id="ethnic_group" value="<?php echo $model->getEthnicGroup(); ?>"  />
				</li>
				<li data-role="fieldcontain">
					<label for="gender_id"><?php echo Yii::t('translation', 'Gender'); ?></label>
					<?php
					$genders = Gender::model()->findAll();
					$list = CHtml::listData($genders, 'id', 'gender_name');
					echo CHtml::dropDownList('gender_id', $model->gender_id, $list);
					?>
				</li>
			</ul>

		<input type="submit" value="OK" id="AddContact" name="AddContact" onclick="return validateBeforeSend();" data-inline="true" data-icon="check" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" />
		<input type="submit" value="<?php echo Yii::t('translation', 'Cancel'); ?>" name="Cancel" data-inline="true" id="Cancel" data-icon="back" />
		
		<script type="text/javascript">
		function validateBeforeSend()
		{
			var first_name_val=$("#first_name").val();
			if(first_name_val=="")
			{
				alert("<?php echo Yii::t('translation', 'First Name cannot be empty'); ?>");
				return false;
			}
			var last_name_val=$("#last_name").val();
			if(last_name_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Last Name cannot be empty'); ?>");
				return false;
			}
			var email_val=$("#email").val();
			if(email_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Email cannot be empty'); ?>");
				return false;
			}
			var contact_number_val=$("#contact_number").val();
			if(contact_number_val=="")
			{
				alert("<?php echo Yii::t('translation', 'Contact Number cannot be empty'); ?>");
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