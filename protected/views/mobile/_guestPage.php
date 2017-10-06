<?php
$cs=Yii::app()->getClientScript();
// $cs->registerCssFile(Yii::app()->baseUrl.'/scripts/touchTouch/assets/touchTouch/touchTouch.css');
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/diapo/scripts/jquery.easing.1.3.js');
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/diapo/scripts/jquery.hoverIntent.minified.js');
// $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/diapo/scripts/diapo.js');
?>

<div>
	<ul data-role="listview" data-theme="c" data-dividertheme="b">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'SMS Management Portal'); ?>:</li>
		<li>
			<div data-role="collapsible-set"  data-theme="c" data-mini="true">
			
			<div data-role="collapsible" data-collapsed="false" >
			<h3>- Server Status</h3>
			</div>
			
			<div data-role="collapsible">
			<h3>- About Us</h3>
			</div>

			<div data-role="collapsible">
			<h3>- What is MnM</h3>
			</div>

			<div data-role="collapsible">
			<h3>- Features</h3>
			</div>

			<div data-role="collapsible">
			<h3>- How it works</h3>
			</div>

			<div data-role="collapsible">
			<h3>- Contact Us</h3>
			<ul data-role="listview" data-theme="c" data-dividertheme="b" data-inset="true">
				<li  data-role="list-divider">Contact Information:</li>
				<li>Contact Number: xxx-xx-xxxxxxxx</li>
				<li>Contact Email: --@---.com</li>
				<li  data-role="list-divider">Address Information:</li>
				<li>Address Line 1</li>
				<li>Address Line 2</li>
				<li>Address Line 3</li>
				<li>Address Line 4</li>
				<li  data-role="list-divider">Have a Good Day!</li>
			</ul>
			</div>

				
				
			</div>
		</li>
	</ul>
</div>
