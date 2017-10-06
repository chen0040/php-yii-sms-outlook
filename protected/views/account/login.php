<div data-role="page" id="login-dialog">
	<div data-role="header" data-theme="e">
		<h1>Login</h1>
	</div><!-- /header -->
	
	<div data-role="content" data-theme="a">	
	<form id="login-form" method="post" action="<?php echo Yii::app()->createUrl('account/login', array('url'=>$url)); ?>" data-ajax="false">
		<div id="usernameDiv" data-role="fieldcontain">
			<label for="username">User ID*</label>		
			<input id="username" name="username" type="text" />
		</div>
		<div id="passwordDiv" data-role="fieldcontain">
			<label for="password" id="fnameLabel" name="fnameLabel">Password*</label>		
			<input id="password" name="password" type="password" />
		</div>
		<div id="rememberMeDiv" data-role="fieldcontain">
			<label for="rememberMe">Remeber Me</label>
			<input id="rememberMe" name="rememberMe" type="checkbox"/>
		</div>
		<div id="returnUrlDiv" data-role="fieldcontain">
			<input id="returnUrl" name="returnUrl" type="hidden" value="<?php echo $url; ?>"/>
		</div>
		
		<table>
		<tr>
		<td style="text-align:center"><a href="<?php echo Yii::app()->createUrl($url); ?>" data-icon="delete" data-role="button" data-inline="true" data-icon="back" class="cancel-btn">Cancel</a></td>
		<td style="text-align:center"><input type="submit" value="Login" id="Login" name="Login" data-inline="true" data-theme="<?php echo Yii::app()->accountMgr->getOKButtonDataTheme(); ?>" data-icon="check" /></td>
		<td style="text-align:center"><input type="submit" value="Forget Password" name="ForgetPassword" id="ForgetPassword" data-inline="true" data-transition="pop" data-rel="dialog" disabled /></td>
		</tr>
		</table>
	</form>
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>&nbsp;</h4>
	</div><!-- /footer -->
</div>