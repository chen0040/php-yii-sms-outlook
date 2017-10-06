<?php

class QRGenerator extends CComponent
{	
	public function __construct()
	{
	}

	public function init()
	{
	}
	
	public function createQRCode($content, $file)
	{
		spl_autoload_unregister(array('YiiBase','autoload')); //required when incorporating third party lib
		require_once Yii::app()->basePath.'/extensions/phpqrcode/qrlib.php';
		spl_autoload_register(array('YiiBase','autoload')); //required when incorporating third party lib
		
		QRcode::png($content, $file);
	}
}
?>