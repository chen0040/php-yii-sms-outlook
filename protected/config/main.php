<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('widgets','protected/widgets');

$ps_themes=array('fly', 'business3', 'orange', 'wpcraft', 'mobile');
$ps_theme=$ps_themes[4];

$ps_dbremote=false;
$ps_dbhost='127.0.0.1';
$ps_dbname='mysql';
$ps_dbusername='root';
$ps_dbpassword='chen0469';

if($ps_dbremote)
{
	$ps_dbhost='remote-host';
	$ps_dbname='remote-db';
	$ps_dbusername='remote-username';
	$ps_dbpassword='remote-password';
	//port: 3306
}

$ps_connectionString='mysql:host='.$ps_dbhost.';dbname='.$ps_dbname;

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Message and Manage',
	
	'theme'=>$ps_theme,

	// preloading 'log' component
	'preload'=>array('log'),
	
	'sourceLanguage' => 'en_us',
	
	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'chen0469',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		/*
		'admin',
		// rbac configured to run with module Yii-User
		'rbac'=>array(
			// Table where Users are stored. RBAC Manager use it as read-only
			'tableUser'=>'cztbl_user', 
			// The PRIMARY column of the User Table
			'columnUserid'=>'id',
			// only for display name and could be same as id
			'columnUsername'=>'username',
			// only for display email for better identify Users
			'columnEmail'=>'email' // email (only for display)
			),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'session' => array (
			'class' => 'system.web.CDbHttpSession',
			'connectionID' => 'db',
			'sessionTableName' => 'vsms_session',
		),
		'browser' => array(
			'class' => 'application.extensions.browser.CBrowserComponent',
		),
		'simpleImage'=>array(
            'class' => 'application.extensions.simpleimage.CSimpleImage',
		),
		'counter' => array(
            'class' => 'application.extensions.UserCounter',
        ),
		'jqGraph' => array(
			'class' => 'application.extensions.JQGPlugin',
        ),
		'QRGen' => array(
			'class' => 'application.extensions.QRGenerator',
        ),
		'accountMgr' => array(
			'class' => 'application.extensions.AccountPlugin',
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => $ps_connectionString,
			'emulatePrepare' => true,
			'username' => $ps_dbusername,
			'password' => $ps_dbpassword,
			'charset' => 'utf8',
		),*/
		'db'=>array(
			'class'=>'application.extensions.PHPPDO.CPdoDbConnection',
			'pdoClass' => 'PHPPDO',
			'connectionString' => $ps_connectionString,
			'emulatePrepare' => true,
			'username' => $ps_dbusername,
			'password' => $ps_dbpassword,
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);