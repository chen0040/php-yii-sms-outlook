<?php

class AccountPlugin extends CComponent
{	
	public function __construct()
	{
	}

	public function init()
	{
	}
	
	public function getAccount()
	{
		$user=null;
		if(isset(Yii::app()->user) && (!Yii::app()->user->isGuest) && isset(Yii::app()->user->cId))
		{
			$user=Account::model()->find('id=?', array(Yii::app()->user->cId));
		}
		return $user;
	}
	
	public function findAdminAccount()
	{
		return Account::model()->find('username="admin"');
	}
	
	public function applyLanguage()
	{
		$model=$this->getAccount();
		if(isset($model))
		{
			$localization=$model->getLanguage();
			if(isset(Yii::app()->session['_lang']))
			{
				$localization=Yii::app()->session['_lang'];
			}	
			Yii::app()->setLanguage(isset($localization) ? $localization : 'en_us'); 
		}
		else
		{
			return 'en_us';
		}
	}
	
	public function getOKButtonDataTheme()
	{
		return 'f';
	}
}
?>