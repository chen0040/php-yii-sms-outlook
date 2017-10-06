<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $pId;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$cId='default';
		$pId=$cId;
		
		$users=array(
			// username => password
			'demo'=>'Aaron.Koh@2012',
			'admin'=>'Ian.Chan@2012',
		);
		if(!isset($users[$this->username]))
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($users[$this->username]!==$this->password)
		{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$acc=Account::model()->findByAttributes(array('username'=>$this->username));
			if(!isset($acc))
			{
				$acc=new Account;
				$acc->username=$this->username;
				$acc->password=$users[$this->username];
				$acc->save();
			}
			$lastLogin=null;
			if(null===$acc->last_login_time)
			{
				$lastLogin=time();
			}
			else
			{
				$lastLogin=strtotime($acc->last_login_time);
			}
			$this->pId=$acc->id;
			$this->setState('cId', $acc->id);
			$this->setState('lastLoginTime', $lastLogin);
			$this->errorCode=self::ERROR_NONE;
		}
		
		if($this->errorCode === self::ERROR_NONE)
		{
			return !$this->errorCode;
		}
		else
		{			
			$user=Account::model()->findByAttributes(array('username'=>$this->username));
			if($user===null)
			{
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
			else
			{
				if($user->password!==$user->encrypt($this->password))
				{
					$ip_address = Yii::app()->request->getUserHostAddress();
					$user->addFailedLoginIP($ip_address);
					$user->save();
					
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
				}
				else
				{
					if(null===$user->last_login_time)
					{
						$lastLogin=time();
					}
					else
					{
						$lastLogin=strtotime($user->last_login_time);
					}
					$this->pId=$user->id;
					$this->setState('cId', $user->id);
					$this->setState('lastLoginTime', $lastLogin);
					$this->errorCode=self::ERROR_NONE;
				}
			}
		}
		
		return !$this->errorCode;
	}
}