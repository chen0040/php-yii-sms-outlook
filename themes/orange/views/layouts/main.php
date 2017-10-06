<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rbac.css" />;

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'Events', 'url'=>array('/event')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Admin', 'url'=>array('/admin/default/index'), 'visible'=>Yii::app()->authManager->checkAccess("admin", Yii::app()->user->id)),
				array('label'=>'My Profile', 'url'=>array('student/myProfileView', 'id'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Student')),
				array('label'=>'My Profile', 'url'=>array('professor/myProfileView', 'id'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Professor')),
				array('label'=>'My Research Fields', 'url'=>array('studentResearchField/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Student')),
				array('label'=>'My Research Fields', 'url'=>array('professorResearchField/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Professor')),
				array('label'=>'My Research Articles', 'url'=>array('studentArticle/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Student')),
				array('label'=>'My Research Articles', 'url'=>array('professorArticle/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Professor')),
				array('label'=>'My Friends', 'url'=>array('studentFriends/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Student')),
				array('label'=>'My Friends', 'url'=>array('professorFriends/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Professor')),
				array('label'=>'My Experiences/Awards', 'url'=>array('awards/index', 'sid'=>Yii::app()->user->getState('cId')), 'visible'=>(Yii::app()->user->hasState('cLoginType') && Yii::app()->user->getState('cLoginType')=='Student')),
				array('label'=>'Contact', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Signup', 'url'=>array('/student/create'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PSLink.<br/>
		All Rights Reserved.<br/>
		<!--<?php echo Yii::powered(); ?>-->
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>