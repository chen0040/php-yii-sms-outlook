<?php echo Yii::app()->accountMgr->applyLanguage(); ?>
<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1><?php echo Yii::t('translation', 'Signup'); ?></h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/submitSignup', array('url'=>$url)); ?>" data-ajax="false">
		<table width="100%">
		<tr>
		<td colspan="2">
		<div id="firstNameDiv" data-role="fieldcontain">
			<label for="firstName" id="firstNameLabel" name="firstNameLabel"><?php echo Yii::t('translation', 'First Name'); ?>*</label>		
			<input id="firstName" name="firstName" type="text" />
		</div>
		</td>
		
		<tr>
		<td colspan="2">
		<div id="firstNameDiv" data-role="fieldcontain">
			<label for="lastName" id="lastNameLabel" name="lastNameLabel">Last Name*</label>		
			<input id="lastName" name="lastName" type="text" />
		</div>
		</td>
		</tr>
		
		<tr>
		<td colspan="2">
		<div id="firstNameDiv" data-role="fieldcontain">
			<label for="phone" id="phoneLabel" name="phoneLabel">Contact Number*</label>		
			<input id="phone" name="phone" type="text" />
		</div>
		</td>
		</tr>
		
		<tr>
		<td colspan="2">
		<div id="firstNameDiv" data-role="fieldcontain">
			<label for="email" id="emailLabel" name="emailLabel">Contact Email*</label>		
			<input id="email" name="email" type="text" />
		</div>
		</td>
		</tr>
		
		<tr>
		<td colspan="2">
		<div id="firstNameDiv" data-role="fieldcontain">
			<label for="description" id="descriptionLabel" name="descriptionLabel">Description*</label>		
			<textarea id="description" name="description"></textarea>
		</div>
		</td>
		</tr>
		
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl($url); ?>" data-icon="delete" data-role="button" data-inline="true" data-icon="back" class="cancel-btn">Cancel</a></td>
		<td style="text-align:center"><input type="submit" value="Signup" name="Signup" id="Signup" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-inline="true" data-icon="check" /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>