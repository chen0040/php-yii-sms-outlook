<div data-role="page" id="public-failed" data-theme="d">
	<div data-role="header" data-theme="a">
		<a href="index.php?r=site/index" data-role="button" data-inline="true" data-icon="home">Home</a>
		<h1>Login Failed: <?php echo $error; ?></h1>
	</div><!-- /header -->
	
	<div data-role="content">	

	<ul data-role="listview" data-theme="c" data-dividertheme="d">
		<li data-role="list-divider"><?php echo $error; ?></li>
		<li><a href="<?php echo Yii::app()->createUrl($url); ?>">Back to Home</a></li>
		<li><a href="<?php echo Yii::app()->createUrl('account/login', array('url'=>$url)); ?>" data-rel="dialog" data-transition="pop">Try to Login Again</a></li>
	</ul>
	</div>

	<?php
	$data_theme='a'; 
	?>

	<div data-role="footer" data-theme="<?php echo $data_theme; ?>">
		<p>&copy; 2012 <?php echo Yii::t('translation', 'SMS Organizer'); ?></p>
	</div>

</div>