<?php

/**
 * This is the model class for table "vsms_account".
 *
 * The followings are the available columns in table 'vsms_account':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $org_name
 * @property integer $gender_id
 * @property string $race
 * @property string $nationality
 * @property string $address_line1
 * @property string $address_line2
 * @property string $address_line3
 * @property string $address_line4
 * @property string $postal
 * @property integer $country_id
 * @property string $province
 * @property string $email1
 * @property string $email2
 * @property string $country_code1
 * @property string $country_code2
 * @property string $area_code1
 * @property string $area_code2
 * @property string $phone1
 * @property string $phone2
 * @property string $create_time
 * @property string $update_time
 * @property string $last_login_time
 * @property string $description
 * @property integer $int_field1
 * @property integer $int_field2
 * @property double $dbl_field1
 * @property double $dbl_field2
 * @property string $varc_field1
 * @property string $varc_field2
 * @property string $txt_field1
 * @property string $txt_field2
 * @property string $dat_field1
 * @property string $dat_field2
 */
class Account extends CActiveRecord
{
	private $idCache;
	const CLASS_NAME='Account';
	const MAX_CONTACTS_SHOWN=7;
	const MAX_GROUPS_SHOWN=7;
	const MAX_TASKS_SHOWN=10;
	const MAX_DRAFT_SHOWN=10;
	const MAX_OUTBOX_SHOWN=10;
	const MAX_SENT_SHOWN=10;
	const MAX_TRASH_SHOWN=10;
	
	const ACCUSER="viaideax";
	const ACCPWD="chen0469"; //best to keep this in your config file      
	const ACCUSERNAME='MnM WebMaster';
	const ACCFROM='viaideax@gmail.com';
	const ACCTO='seamus.compute@gmail.com';
	
	const DEFAULT_INITIAL_CREDIT=1000000;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getExpiryDate()
	{
		if(!isset($this->dat_field1) || $this->dat_field1=='')
		{
			$dd=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y")+1);
			$this->dat_field1=date('Y-m-d H:i:s', $dd);
		}
		
		return $this->dat_field1;
	}
	
	public function clearFailedLoginIPForLastHour()
	{
		/*
		$ips=$this->txt_field2;
		$iparr=explode('|', $ips);
		$ipcount=count($iparr);
		
		$today=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y"));
		$arr=array();
		for($idx=0; $idx+1 < $ipcount; $idx+=2)
		{
			$ipaddr=$iparr[$idx];
			$ipdate=$iparr[$idx+1];
			
			$logintime=strtotime($ipdate);
			
			$diff = $today - $logintime;
		
			if($diff < 3600 && strcmp($ipaddr, $ip)!=0)
			{
				$arr[$ipdate]=$ipaddr;
			}
		}
		$ipdate=date('Y-m-d H:i:s', $today);
		$arr[$ipdate]=$ip;
		
		$result='';
		$first_item=true;
		foreach($arr as $arr_key => $arr_val)
		{
			if($first_item)
			{
				$first_item=false;
			}
			else
			{
				$result.='|';
			}
			$result.=($arr_val.'|'.$arr_key);
		}
		
		$this->txt_field2=$result;
		*/
		$this->txt_field2='';
	}
	
	public function getFailedLoginIPCountForLastHour($ip)
	{
		$ips=$this->txt_field2;
		$iparr=explode('|', $ips);
		$ipcount=count($iparr);
		
		$today=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y"));
		$count=0;
		for($idx=0; $idx+1 < $ipcount; $idx+=2)
		{
			$ipaddr=$iparr[$idx];
			$ipdate=$iparr[$idx+1];
			
			$logintime=strtotime($ipdate);
			
			$diff = $today - $logintime;
		
			if($diff < 3600 && strcmp($ipaddr, $ip)==0)
			{
				$count++;
			}
		}
		return $count;
	}
	
	public function addFailedLoginIP($ip)
	{
		$ips=$this->txt_field2;
		$iparr=explode('|', $ips);
		$ipcount=count($iparr);
		
		$today=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y"));
		$arr=array();
		$arr2=array();
		for($idx=0; $idx+1 < $ipcount; $idx+=2)
		{
			$ipaddr=$iparr[$idx];
			$ipdate=$iparr[$idx+1];
			
			$logintime=strtotime($ipdate);
			
			$diff = $today - $logintime;
		
			if($diff < 3600)
			{
				if(strcmp($ipaddr, $ip)==0)
				{
					if(count($arr2) < 4)
					{
						$arr2[$ipdate]=$ipaddr;
					}
				}
				else
				{
					$arr[$ipdate]=$ipaddr;
				}
			}
		}
		$ipdate=date('Y-m-d H:i:s', $today);
		$arr2[$ipdate]=$ip;
		
		$result='';
		$first_item=true;
		foreach($arr as $arr_key => $arr_val)
		{
			if($first_item)
			{
				$first_item=false;
			}
			else
			{
				$result.='|';
			}
			$result.=($arr_val.'|'.$arr_key);
		}
		
		$first_item=true;
		foreach($arr2 as $arr_key => $arr_val)
		{
			if($first_item && strcmp($result, '')==0)
			{
				$first_item=false;
			}
			else
			{
				$result.='|';
			}
			$result.=($arr_val.'|'.$arr_key);
		}
		
		$this->txt_field2=$result;
	}
	
	
	public function setAccountStatus($status)
	{
		$this->int_field2=$status;
	}
	
	public function getAccountStatus()
	{
		if(!isset($this->int_field2))
		{
			$this->int_field2=0;
		}
		return $this->int_field2;
	}
	
	public function isSuspended()
	{
		
		return $this->getAccountStatus()==1;
	}
	
	public function suspend()
	{
		$this->setAccountStatus(1);
	}
	
	public function activate()
	{
		$this->setAccountStatus(0);
	}
	
	public function setExpiryDate($dat)
	{
		$this->dat_field1=$dat;
	}
	
	public function hasExpired()
	{
		/*
		$exp_dat=$this->getExpiryDate();
		if(!isset($dat) || $dat =='')
		{
			$exp_dat=date('Y-m-d H:i:s');
		}
		
		$today=strtotime(date('Y-M-d H:i:s'));
		$expiration_date=strtotime($exp_dat);
		if ($expiration_date > $today) 
		{
			 $valid = true;
		} 
		else 
		{
			 $valid = false;
		}
		return $valid==false;
		*/
		return $this->getRemainingDays() <= 0;
	}
	
	public function getRemainingDays()
	{
		$today=mktime(date('H'), date('i'), date('s'), date("m"),   date("d"),   date("Y"));
		$expiry_date=strtotime($this->getExpiryDate());
		
		$diff = $expiry_date - $today;
		
		$days=floor($diff/(60*60*24));

		//$years = floor($diff / (365*60*60*24));
		//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		return $days;
	}
	
	public function getCredit()
	{
		if($this->isAdmin())
		{
			return Account::DEFAULT_INITIAL_CREDIT;
		}
		if(!isset($this->int_field1))
		{
			$this->int_field1=Account::DEFAULT_INITIAL_CREDIT;
		}
			
		return $this->int_field1;
	}
	
	public function setCredit($val)
	{
		$this->int_field1=$val;
	}
	
	public function decreaseCredit($val)
	{
		$this->int_field1-=$val;
	}
	
	public function increaseCredit($val)
	{
		$this->int_field1+=$val;
	}
	
	public function getMaxOutboxMailCountPerPage()
	{
		return Account::MAX_OUTBOX_SHOWN;
	}
	
	public function getMaxTrashMailCountPerPage()
	{
		return Account::MAX_TRASH_SHOWN;
	}
	
	public function getMaxSentMailCountPerPage()
	{
		return Account::MAX_SENT_SHOWN;
	}
	
	public function getMaxDraftMailCountPerPage()
	{
		return Account::MAX_DRAFT_SHOWN;
	}
	
	public function getMaxContactCountPerPage()
	{
		return Account::MAX_CONTACTS_SHOWN;
	}
	
	public function getMaxGroupCountPerPage()
	{
		return Account::MAX_GROUPS_SHOWN;
	}
	
	public function getLanguage()
	{
		$language = $this->race;
		if(!isset($language) || $language==='')
		{
			return 'en_us';
		}
		return $language;
	}
	
	public function setLanguage($lang)
	{
		$this->race=$lang;
	}
	
	public function getLanguageName()
	{
		$lang=$this->getLanguage();
		if($lang==='en_us')
		{
			return Yii::t('translation', 'English');
		}
		else if($lang==='zh_cn')
		{
			return Yii::t('translation', 'Chinese');
		}
		return 'NA';
	}
	
	public function tag_lcase()
	{
		return 'account';
	}
	
	public function tag_ucase()
	{
		return 'Account';
	}
	
	public function setTheme($theme)
	{
		$this->varc_field1=$theme;
	}
	
	public function getTheme()
	{
		if(isset($this->varc_field1))
		{
			return $this->varc_field1;
		}
		return 'c';
	}
	
	public function data_divider_theme()
	{
		if(isset($this->varc_field1))
		{
			return $this->varc_field1;
		}
		return 'c';
	}
	
	public function data_theme()
	{
		if(isset($this->varc_field1))
		{
			return $this->varc_field1;
		}
		return 'c';
	}
	
	public function getUsername()
	{
		$username=$this->username;
		if(isset($this->first_name))
		{
			$username=$this->first_name.' '.$this->last_name;
		}
	
		return $username;
	}
	
	public function getThemeName()
	{
		$theme=$this->getTheme();
		if($theme==='a')
		{
			return Yii::t('translation', 'Black');
		}
		else if($theme==='b')
		{
			return Yii::t('translation', 'Blue');
		}
		else if($theme==='c')
		{
			return Yii::t('translation', 'Silver');
		}
		else if($theme==='d')
		{
			return Yii::t('translation', 'Gray');
		}
		else if($theme==='e')
		{
			return Yii::t('translation', 'Yellow');
		}
		else if($theme==='f')
		{
			return Yii::t('translation', 'Green');
		}
		return 'NA';
	}
	
	public function header_data_theme()
	{
		if(isset($this->varc_field2))
		{
			return $this->varc_field2;
		}
		return 'c';
	}
	
	public function setHeaderDataTheme($theme)
	{
		$this->varc_field2=$theme;
	}
	
	public function footer_data_theme()
	{
		if(isset($this->varc_field2))
		{
			return $this->varc_field2;
		}
		return 'a';
	}
	
	public function setSecretPhase($words)
	{
		$this->txt_field1=$words;
	}
	
	public function getSecretPhase()
	{
		return $this->txt_field1;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vsms_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gender_id, country_id, int_field1, int_field2', 'numerical', 'integerOnly'=>true),
			array('dbl_field1, dbl_field2', 'numerical'),
			array('username, password, first_name, last_name, race, nationality, address_line1, address_line2, address_line3, address_line4, province, email1, email2, phone1, phone2', 'length', 'max'=>128),
			array('org_name, varc_field1, varc_field2', 'length', 'max'=>255),
			array('postal', 'length', 'max'=>16),
			array('country_code1, country_code2, area_code1, area_code2', 'length', 'max'=>4),
			array('create_time, update_time, last_login_time, description, txt_field1, txt_field2, dat_field1, dat_field2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, first_name, last_name, org_name, gender_id, race, nationality, address_line1, address_line2, address_line3, address_line4, postal, country_id, province, email1, email2, country_code1, country_code2, area_code1, area_code2, phone1, phone2, create_time, update_time, last_login_time, description, int_field1, int_field2, dbl_field1, dbl_field2, varc_field1, varc_field2, txt_field1, txt_field2, dat_field1, dat_field2', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'org_name' => 'Org Name',
			'gender_id' => 'Gender',
			'race' => 'Race',
			'nationality' => 'Nationality',
			'address_line1' => 'Address Line1',
			'address_line2' => 'Address Line2',
			'address_line3' => 'Address Line3',
			'address_line4' => 'Address Line4',
			'postal' => 'Postal',
			'country_id' => 'Country',
			'province' => 'Province',
			'email1' => 'Email1',
			'email2' => 'Email2',
			'country_code1' => 'Country Code1',
			'country_code2' => 'Country Code2',
			'area_code1' => 'Area Code1',
			'area_code2' => 'Area Code2',
			'phone1' => 'Phone1',
			'phone2' => 'Phone2',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'last_login_time' => 'Last Login Time',
			'description' => 'Description',
			'int_field1' => 'Int Field1',
			'int_field2' => 'Int Field2',
			'dbl_field1' => 'Dbl Field1',
			'dbl_field2' => 'Dbl Field2',
			'varc_field1' => 'Varc Field1',
			'varc_field2' => 'Varc Field2',
			'txt_field1' => 'Txt Field1',
			'txt_field2' => 'Txt Field2',
			'dat_field1' => 'Dat Field1',
			'dat_field2' => 'Dat Field2',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('org_name',$this->org_name,true);
		$criteria->compare('gender_id',$this->gender_id);
		$criteria->compare('race',$this->race,true);
		$criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('address_line1',$this->address_line1,true);
		$criteria->compare('address_line2',$this->address_line2,true);
		$criteria->compare('address_line3',$this->address_line3,true);
		$criteria->compare('address_line4',$this->address_line4,true);
		$criteria->compare('postal',$this->postal,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('email1',$this->email1,true);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('country_code1',$this->country_code1,true);
		$criteria->compare('country_code2',$this->country_code2,true);
		$criteria->compare('area_code1',$this->area_code1,true);
		$criteria->compare('area_code2',$this->area_code2,true);
		$criteria->compare('phone1',$this->phone1,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('int_field1',$this->int_field1);
		$criteria->compare('int_field2',$this->int_field2);
		$criteria->compare('dbl_field1',$this->dbl_field1);
		$criteria->compare('dbl_field2',$this->dbl_field2);
		$criteria->compare('varc_field1',$this->varc_field1,true);
		$criteria->compare('varc_field2',$this->varc_field2,true);
		$criteria->compare('txt_field1',$this->txt_field1,true);
		$criteria->compare('txt_field2',$this->txt_field2,true);
		$criteria->compare('dat_field1',$this->dat_field1,true);
		$criteria->compare('dat_field2',$this->dat_field2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeValidate() 
	{
		if($this->isNewRecord)
		{
			// set the create date, last updated date and the user doing the creating
			$this->create_time=$this->update_time=new CDbExpression('NOW()');
			$this->update_time=new CDbExpression('NOW()'); 
			
			$existing_account=Account::model()->find('username=?', array($this->username));
			if(isset($existing_account))
			{
				return false;
			}
		}
		else
		{
			//not a new record, so just set the last updated time and last updated user id
			$this->update_time=new CDbExpression('NOW()'); 
		}
		
		return parent::beforeValidate();
	}
	
	public function encrypt($value)
	{
		return md5($value);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->gender_id=0;
			$this->country_id=0;
			$this->create_time=$this->update_time=new CDbExpression('NOW()');
			$this->last_login_time=$this->create_time;
			$this->password = $this->encrypt($this->password);
		}
		else
		{
			$this->update_time=new CDbExpression('NOW()'); 
		}
		return TRUE;
	}
	
	public function beforeDelete()
    {
        $this->idCache = $this->id;

        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        $criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId',
                'params' => array(
                    ':accountId' => $this->idCache),
            ));

        $children = GroupContact::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$children = Contact::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$children = Group::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$filename=$this->getImagePath();
		if(file_exists($filename))
		{
			unlink($filename);
		}
		$filename=$this->getThumbnailImagePath();
		if(file_exists($filename))
		{
			unlink($filename);
		}

        parent::afterDelete();
    }
	
	public function isAdmin()
	{
		return $this->username==='admin';
	}
	
	public function isDemo()
	{
		return $this->username==='demo';
	}
	
	public function isNormal()
	{
		return $this->username!=='admin' && $this->username!=='demo';
	}
	
	public function clearOutboxMails()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId AND status = :statusId',
                'params' => array(
                    ':accountId' => $this->id,
					':statusId' => MailSms::STATUS_OUTBOX),
            ));

        $children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearSentMails()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId AND status = :statusId',
                'params' => array(
                    ':accountId' => $this->id,
					':statusId' => MailSms::STATUS_SENT),
            ));

        $children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearDraftMails()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId AND status = :statusId',
                'params' => array(
                    ':accountId' => $this->id,
					':statusId' => MailSms::STATUS_DRAFT),
            ));

        $children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearTrashMails()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId AND status = :statusId',
                'params' => array(
                    ':accountId' => $this->id,
					':statusId' => MailSms::STATUS_TRASH),
            ));

        $children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearTasks()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId AND sms_type = :typeId',
                'params' => array(
                    ':accountId' => $this->id,
					':typeId' => MailSms::TYPE_TASK),
            ));

        $children = MailSms::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearGroups()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId',
                'params' => array(
                    ':accountId' => $this->id),
            ));
			
		$children = Group::model()->findAll($criteria);
		
		foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function clearContacts()
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id=:accountId',
                'params' => array(
                    ':accountId' => $this->id),
            ));
		
		$children = Contact::model()->findAll($criteria);
		
		foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function getImagePath()
	{
		return $this->getImagePathWithExt('png');
	}
	
	public function getRawImagePath()
	{
		return $this->getRawImagePathWithExt('png');
	}
	
	public function getThumbnailImagePath()
	{
		return $this->getThumbnailImagePathWithExt('png');
	}
	
	public function getThumbnailImagePathWithExt($ext)
	{
		return 'images/ta_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathWithExt($ext)
	{
		return 'images/a_'.$this->id.'.'.$ext;
	}
	
	public function getRawImagePathWithExt($ext)
	{
		return 'images/ra_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathIfFileExists()
	{
		$filename=$this->getImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/default_profile_image.png';
	}
	
	public function getThumbnailImagePathIfFileExists()
	{
		$filename=$this->getThumbnailImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/default_profile_image.png';
	}
	
	public function getLocalization()
	{
		return $this->phone2;
	}
	
	public function setLocalization($loc)
	{
		$this->phone2=$loc;
	}
	
	public function getContacts($id, $id_max, $id_min, $search_keywords)
	{
		if($id==-1)
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			}
			return Contact::model()->findAll($criteria);
		}		
		else if($id==-2) //next higher page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :contactId', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id_max),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :contactId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id_max, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			}
			$contacts = Contact::model()->findAll($criteria);
			if(count($contacts)> 0)
			{
				return array_reverse($contacts, false);
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			}
			return Contact::model()->findAll($criteria);
		}
		else if($id==-3) //next lower page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :contactId', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id_min),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :contactId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id_min, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			}
			$contacts = Contact::model()->findAll($criteria);
			if(count($contacts) > 0)
			{
				return $contacts;
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
			}
			$contacts = Contact::model()->findAll($criteria);
			return array_reverse($contacts, false);
		}
		if($id!=-1)
		{		
			if($id < $id_min)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :contactId', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :contactId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				}
				$contacts=Contact::model()->findAll($criteria);
				
				return array_reverse($contacts, false);
			}
			else if($id > $id_max)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :contactId', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :contactId AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':contactId'=>$id, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				}
				return Contact::model()->findAll($criteria);
			}
			else
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :contactId1 AND id >= :contactId2', 
					'params'=>array(':accountId'=>$this->id, ':contactId1'=>$id_max, ':contactId2'=>$id_min),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :contactId1 AND id >= :contactId2 AND first_name LIKE :first_name_match', 
					'params'=>array(':accountId'=>$this->id, ':contactId1'=>$id_max, ':contactId2'=>$id_min, ':first_name_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_CONTACTS_SHOWN));
				}
				return Contact::model()->findAll($criteria);
			}
			
		}
		
		return $contacts;
	}
	
	public function getContactById($id)
	{
		$contact = Contact::model()->findByPk($id);
		return $contact;
	}
	
	public function getContactCount()
	{
		$count = Contact::model()->count("account_id=:accountId", array("accountId" => $this->id));
		return $count;
	}
	
	public function getGroups($id, $id_max, $id_min, $search_keywords)
	{
		if($id==-1)
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			}
			return Group::model()->findAll($criteria);
		}		
		else if($id==-2) //next higher page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :groupId', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id_max),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :groupId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id_max, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			}
			$groups = Group::model()->findAll($criteria);
			if(count($groups)> 0)
			{
				return array_reverse($groups, false);
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			}
			return Group::model()->findAll($criteria);
		}
		else if($id==-3) //next lower page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :groupId', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id_min),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :groupId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id_min, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			}
			$groups = Group::model()->findAll($criteria);
			if(count($groups) > 0)
			{
				return $groups;
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId', 
					'params'=>array(':accountId'=>$this->id),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
			}
			$groups = Group::model()->findAll($criteria);
			return array_reverse($groups, false);
		}
		if($id!=-1)
		{		
			if($id < $id_min)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :groupId', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :groupId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				}
				$groups=Group::model()->findAll($criteria);
				
				return array_reverse($groups, false);
			}
			else if($id > $id_max)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :groupId', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :groupId AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupId'=>$id, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				}
				return Group::model()->findAll($criteria);
			}
			else
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :groupId1 AND id >= :groupId2', 
					'params'=>array(':accountId'=>$this->id, ':groupId1'=>$id_max, ':groupId2'=>$id_min),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :groupId1 AND id >= :groupId2 AND groupname LIKE :groupname_match', 
					'params'=>array(':accountId'=>$this->id, ':groupId1'=>$id_max, ':groupId2'=>$id_min, ':groupname_match'=>'%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => Account::MAX_GROUPS_SHOWN));
				}
				return Group::model()->findAll($criteria);
			}
			
		}
		
		return $groups;
	}
	
	public function getGroupById($id)
	{
		$group = Group::model()->findByPk($id);
		return $group;
	}
	
	public function getGroupCount()
	{
		$count = Group::model()->count("account_id=:accountId", array("accountId" => $this->id));
		return $count;
	}
	
	public function getTasks($id, $id_max, $id_min)
	{
		if($id==-1)
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id DESC',
					'limit' => Account::MAX_TASKS_SHOWN));
			return MailSms::model()->findAll($criteria);
		}		
		else if($id==-2) //next higher page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :taskId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':taskId'=>$id_max, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id ASC',
					'limit' => Account::MAX_TASKS_SHOWN));
			$tasks = MailSms::model()->findAll($criteria);
			if(count($tasks)> 0)
			{
				return array_reverse($tasks, false);
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id DESC',
					'limit' => Account::MAX_TASKS_SHOWN));
			return MailSms::model()->findAll($criteria);
		}
		else if($id==-3) //next lower page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :taskId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':taskId'=>$id_min, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id DESC',
					'limit' => Account::MAX_TASKS_SHOWN));
			$tasks = MailSms::model()->findAll($criteria);
			if(count($tasks) > 0)
			{
				return $tasks;
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id ASC',
					'limit' => Account::MAX_TASKS_SHOWN));
			$tasks = MailSms::model()->findAll($criteria);
			return array_reverse($tasks, false);
		}
		if($id!=-1)
		{		
			if($id < $id_min)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :taskId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':taskId'=>$id, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id ASC',
					'limit' => Account::MAX_TASKS_SHOWN));
				$tasks=MailSms::model()->findAll($criteria);
				
				return array_reverse($tasks, false);
			}
			else if($id > $id_max)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :taskId AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':taskId'=>$id, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id DESC',
					'limit' => Account::MAX_TASKS_SHOWN));
				return MailSms::model()->findAll($criteria);
			}
			else
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :taskId1 AND id >= :taskId2 AND sms_type = :typeId', 
					'params'=>array(':accountId'=>$this->id, ':taskId1'=>$id_max, ':taskId2'=>$id_min, ':typeId' => MailSms::TYPE_TASK),
					'order'=>'id DESC',
					'limit' => Account::MAX_TASKS_SHOWN));
				return MailSms::model()->findAll($criteria);
			}
			
		}
		
		return $tasks;
	}
	
	public function getTaskById($id)
	{
		$task = MailSms::model()->findByPk($id);
		return $task;
	}
	
	public function getTaskCount()
	{
		$count = MailSms::model()->count("account_id=:accountId AND sms_type = :typeId", array("accountId" => $this->id, ':typeId' => MailSms::TYPE_TASK));
		return $count;
	}
	
	public function getDrafts($id, $id_max, $id_min, $search_keywords)
	{
		return $this->getMailSmsList($id, $id_max, $id_min, $search_keywords, MailSms::STATUS_DRAFT);
	}
	
	public function getDraftById($id)
	{
		$draft = MailSms::model()->findByPk($id);
		return $draft;
	}
	
	public function getDraftCount()
	{
		$count = MailSms::model()->count("account_id=:accountId AND sms_type = :typeId AND status = :status", array("accountId" => $this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => MailSms::STATUS_DRAFT));
		return $count;
	}
	
	public function getSentMails($id, $id_max, $id_min, $search_keywords)
	{
		return $this->getMailSmsList($id, $id_max, $id_min, $search_keywords, MailSms::STATUS_SENT);
	}
	
	public function getSentMailById($id)
	{
		$sentmail = MailSms::model()->findByPk($id);
		return $sentmail;
	}
	
	public function getSentMailCount()
	{
		$count = MailSms::model()->count("account_id=:accountId AND sms_type = :typeId AND status = :status", array("accountId" => $this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => MailSms::STATUS_SENT));
		return $count;
	}
	
	public function getTrashMails($id, $id_max, $id_min, $search_keywords)
	{
		return $this->getMailSmsList($id, $id_max, $id_min, $search_keywords, MailSms::STATUS_TRASH);
	}
	
	public function getTrashMailById($id)
	{
		$trashmail = MailSms::model()->findByPk($id);
		return $trashmail;
	}
	
	public function getTrashMailCount()
	{
		$count = MailSms::model()->count("account_id=:accountId AND sms_type = :typeId AND status = :status", array("accountId" => $this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => MailSms::STATUS_TRASH));
		return $count;
	}
	
	public function getOutboxs($id, $id_max, $id_min, $search_keywords)
	{
		return $this->getMailSmsList($id, $id_max, $id_min, $search_keywords, MailSms::STATUS_OUTBOX);
	}
	
	private function getMailSmsListLimit($status)
	{
		if($status==MailSms::STATUS_OUTBOX)
		{
			return Account::MAX_OUTBOX_SHOWN;
		}
		else if($status==MailSms::STATUS_SENT)
		{
			return Account::MAX_SENT_SHOWN;
		}
		else if($status==MailSms::STATUS_DRAFT)
		{
			return Account::MAX_DRAFT_SHOWN;
		}
		else if($status==MailSms::STATUS_TRASH)
		{
			return Account::MAX_TRASH_SHOWN;
		}
		
		return Account::MAX_OUTBOX_SHOWN;
	}
	
	public function getMailSmsList($id, $id_max, $id_min, $search_keywords, $status)
	{
		$limit=$this->getMailSmsListLimit($status);
		if($id==-1)
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id DESC',
					'limit' => $limit));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => $limit));
			}
			return MailSms::model()->findAll($criteria);
		}		
		else if($id==-2) //next higher page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :outboxId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id_max, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id ASC',
					'limit' => $limit));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id > :outboxId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id_max, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => $limit));
			}
			$mailSmsList = MailSms::model()->findAll($criteria);
			if(count($mailSmsList)> 0)
			{
				return array_reverse($mailSmsList, false);
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id DESC',
					'limit' => $limit));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => $limit));
			}
			return MailSms::model()->findAll($criteria);
		}
		else if($id==-3) //next lower page
		{
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :outboxId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id_min, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id DESC',
					'limit' => $limit));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id < :outboxId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id_min, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => $limit));
			}
			$mailSmsList = MailSms::model()->findAll($criteria);
			if(count($mailSmsList) > 0)
			{
				return $mailSmsList;
			}
			$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id ASC',
					'limit' => $limit));
			if(isset($search_keywords) && $search_keywords !== '')
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => $limit));
			}
			$mailSmsList = MailSms::model()->findAll($criteria);
			return array_reverse($mailSmsList, false);
		}
		if($id!=-1)
		{		
			if($id < $id_min)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :outboxId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id ASC',
					'limit' => $limit));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id >= :outboxId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id ASC',
					'limit' => $limit));
				}
				$mailSmsList=MailSms::model()->findAll($criteria);
				
				return array_reverse($mailSmsList, false);
			}
			else if($id > $id_max)
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :outboxId AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id DESC',
					'limit' => $limit));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :outboxId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':outboxId'=>$id, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => $limit));
				}
				return MailSms::model()->findAll($criteria);
			}
			else
			{
				$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :outboxId1 AND id >= :outboxId2 AND sms_type = :typeId AND status = :status', 
					'params'=>array(':accountId'=>$this->id, ':outboxId1'=>$id_max, ':outboxId2'=>$id_min, ':typeId' => MailSms::TYPE_SMS, ':status' => $status),
					'order'=>'id DESC',
					'limit' => $limit));
				if(isset($search_keywords) && $search_keywords !== '')
				{
					$criteria=new CDbCriteria(array(
					'condition'=>'account_id=:accountId AND id <= :outboxId1 AND id >= :outboxId2 AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match', 
					'params'=>array(':accountId'=>$this->id, ':outboxId1'=>$id_max, ':outboxId2'=>$id_min, ':typeId' => MailSms::TYPE_SMS, ':status' => $status, ':message_body_match' => '%'.$search_keywords.'%'),
					'order'=>'id DESC',
					'limit' => $limit));
				}
				return MailSms::model()->findAll($criteria);
			}
			
		}
		
		return $mailSmsList;
	}
	
	public function getOutboxById($id)
	{
		$outbox = MailSms::model()->findByPk($id);
		return $outbox;
	}
	
	public function getOutboxCount()
	{
		$count = MailSms::model()->count("account_id=:accountId AND sms_type = :typeId AND status = :status", array("accountId" => $this->id, ':typeId' => MailSms::TYPE_SMS, ':status' => MailSms::STATUS_OUTBOX));
		return $count;
	}
	
	public function getNextLowerContactId($id, $search_keywords)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id < :contactId AND account_id = :accountId',
                'params' => array(
                    ':contactId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id < :contactId AND account_id = :accountId AND first_name LIKE :first_name_match',
                'params' => array(
                    ':contactId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':first_name_match' => '%'.$search_keywords.'%'),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		}
        $children = Contact::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextHigherContactId($id, $search_keywords)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id > :contactId AND account_id = :accountId',
                'params' => array(
                    ':contactId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id > :contactId AND account_id = :accountId AND first_name LIKE :first_name_match',
                'params' => array(
                    ':contactId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':first_name_match' => '%'.$search_keywords.'%'),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		}
        $children = Contact::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextLowerGroupId($id, $search_keywords)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id < :groupId AND account_id = :accountId',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id < :groupId AND account_id = :accountId AND groupname  LIKE :groupname_match',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':groupname_match' => '%'.$search_keywords.'%'),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		}
        $children = Group::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextHigherGroupId($id, $search_keywords)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id > :groupId AND account_id = :accountId',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id > :groupId AND account_id = :accountId AND groupname LIKE :groupname_match',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':groupname_match' => '%'.$search_keywords.'%'),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		}
        $children = Group::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextLowerTaskId($id)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id < :taskId AND account_id = :accountId AND sms_type = :typeId',
                'params' => array(
                    ':taskId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_TASK),
				'order' => 'id DESC',
				'limit' => 1,
            ));

        $children = MailSms::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextHigherTaskId($id)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id > :taskId AND account_id = :accountId AND sms_type = :typeId',
                'params' => array(
                    ':taskId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_TASK),
				'order' => 'id ASC',
				'limit' => 1,
            ));

        $children = MailSms::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextLowerDraftId($id, $search_keywords)
	{
		return $this->getNextLowerMailSmsId($id, $search_keywords, MailSms::STATUS_DRAFT);
	}
	
	public function getNextHigherDraftId($id, $search_keywords)
	{
		return $this->getNextHigherMailSmsId($id, $search_keywords, MailSms::STATUS_DRAFT);
	}
	
	public function getNextLowerSentMailId($id, $search_keywords)
	{
		return $this->getNextLowerMailSmsId($id, $search_keywords, MailSms::STATUS_SENT);
	}
	
	public function getNextHigherSentMailId($id, $search_keywords)
	{
		return $this->getNextHigherMailSmsId($id, $search_keywords, MailSms::STATUS_SENT);
	}
	
	public function getNextLowerTrashMailId($id, $search_keywords)
	{
		return $this->getNextLowerMailSmsId($id, $search_keywords, MailSms::STATUS_TRASH);
	}
	
	public function getNextHigherTrashMailId($id, $search_keywords)
	{
		return $this->getNextHigherMailSmsId($id, $search_keywords, MailSms::STATUS_TRASH);
	}
	
	public function getNextLowerOutboxId($id, $search_keywords)
	{
		return $this->getNextLowerMailSmsId($id, $search_keywords, MailSms::STATUS_OUTBOX);
	}
	
	public function getNextHigherOutboxId($id, $search_keywords)
	{
		return $this->getNextHigherMailSmsId($id, $search_keywords, MailSms::STATUS_OUTBOX);
	}
	
	private function getNextHigherMailSmsId($id, $search_keywords, $status)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id > :outboxId AND account_id = :accountId AND sms_type = :typeId AND status = :status',
                'params' => array(
                    ':outboxId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_SMS,
					':status' => $status),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id > :outboxId AND account_id = :accountId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match',
                'params' => array(
                    ':outboxId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_SMS,
					':status' => $status,
					':message_body_match' => '%'.$search_keywords.'%'),
				'order' => 'id ASC',
				'limit' => 1,
            ));
		}
        $children = MailSms::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	private function getNextLowerMailSmsId($id, $search_keywords, $status)
	{
		$_id=$id;
		$criteria = new CDbCriteria(array(
                'condition' => 'id < :outboxId AND account_id = :accountId AND sms_type = :typeId AND status = :status',
                'params' => array(
                    ':outboxId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_SMS,
					':status' => $status),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		if(isset($search_keywords) && $search_keywords !== '')
		{
			$criteria = new CDbCriteria(array(
                'condition' => 'id < :outboxId AND account_id = :accountId AND sms_type = :typeId AND status = :status AND message_body LIKE :message_body_match',
                'params' => array(
                    ':outboxId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_SMS,
					':status' => $status,
					':message_body_match' => '%'.$search_keywords.'%'),
				'order' => 'id DESC',
				'limit' => 1,
            ));
		}
        $children = MailSms::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getMailSmsTemplates()
	{
		$status=MailSms::STATUS_SMS_TEMPLATE;
		$criteria = new CDbCriteria(array(
                'condition' => 'account_id = :accountId AND sms_type = :typeId AND status = :status',
                'params' => array(
					':accountId' => Yii::app()->accountMgr->getAccount()->id,
					':typeId' => MailSms::TYPE_SMS,
					':status' => $status),
				'order' => 'id DESC',
            ));
		return MailSms::model()->findAll($criteria);
	}
}