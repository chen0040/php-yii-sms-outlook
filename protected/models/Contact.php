<?php

/**
 * This is the model class for table "vsms_contact".
 *
 * The followings are the available columns in table 'vsms_contact':
 * @property integer $id
 * @property string $username
 * @property integer $account_id
 * @property string $first_name
 * @property string $last_name
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
class Contact extends CActiveRecord
{
	private $idCache;
	const CLASS_NAME='Contact';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vsms_contact';
	}
	
	public function getClassName()
	{
		return Contact::CLASS_NAME;
	}
	
	
	public function setDOB($dat)
	{
		$this->dat_field1=$dat;
	}
	
	public function getDOB()
	{
		return $this->dat_field1;
	}
	
	public function setEthnicGroup($race)
	{
		$this->race=$race;
	}
	
	public function getEthnicGroup()
	{
		return $this->race;
	}
	
	public function setMale()
	{
		$this->gender_id=1;
	}
	
	public function setFemale()
	{
		$this->gender_id=2;
	}
	
	public function isMale()
	{
		return $this->gender==1;
	}
	
	public function isFemale()
	{
		return $this->gender==2;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, gender_id, country_id, int_field1, int_field2', 'numerical', 'integerOnly'=>true),
			array('dbl_field1, dbl_field2', 'numerical'),
			array('username, first_name, last_name, race, nationality, address_line1, address_line2, address_line3, address_line4, province, email1, email2, phone1, phone2', 'length', 'max'=>128),
			array('postal', 'length', 'max'=>16),
			array('country_code1, country_code2, area_code1, area_code2', 'length', 'max'=>4),
			array('varc_field1, varc_field2', 'length', 'max'=>255),
			array('create_time, update_time, last_login_time, description, txt_field1, txt_field2, dat_field1, dat_field2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, account_id, first_name, last_name, gender_id, race, nationality, address_line1, address_line2, address_line3, address_line4, postal, country_id, province, email1, email2, country_code1, country_code2, area_code1, area_code2, phone1, phone2, create_time, update_time, last_login_time, description, int_field1, int_field2, dbl_field1, dbl_field2, varc_field1, varc_field2, txt_field1, txt_field2, dat_field1, dat_field2', 'safe', 'on'=>'search'),
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
			'account_id' => 'Account',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
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
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
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
	
	public function getContactNumber()
	{
		return $this->phone1;
	}
	
	public function setContactNumber($contact_number)
	{
		$this->phone1=$contact_number;
	}
	
	public function getLastName()
	{
		return $this->last_name;
	}
	
	public function setLastName($name)
	{
		$this->last_name=$name;
	}
	
	public function getFirstName()
	{
		return $this->first_name;
	}
	
	public function setFirstName($name)
	{
		$this->first_name=$name;
	}
	
	public function getEmail()
	{
		return $this->email1;
	}
	
	public function getOrg()
	{
		return $this->varc_field1;
	}
	
	public function setOrg($org)
	{
		return $this->varc_field1=$org;
	}
	
	public function setEmail($email)
	{
		$this->email1=$email;
	}
	
	public function getGroupCount()
	{
		$count=GroupContact::model()->count("contact_id=:contactId", array("contactId" => $this->id));
		return $count;
	}
	
	public function getGroups()
	{
		$groups=array();
		$group_contacts=GroupContact::model()->findAll("contact_id=:contactId", array("contactId"=>$this->id));
		foreach($group_contacts as $gc)
		{
			$group_id=$gc->group_id;
			$group=Group::model()->findByPk($group_id);
			if(isset($group))
			{
				$groups[]=$group;
			}
		}
		return $groups;
	}
	
	public function getOutboxMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND to_contact_id = :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_IND_OUTBOX, ':match' => $this->id)
		) );

		return MailSms::model()->findAll($q);
	}
	
	public function getDraftMails()
	{
		
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_DRAFT, ':match' => '%c'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasContact($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function getSentMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND to_contact_id = :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_IND_SENT, ':match' => $this->id)
		) );

		return MailSms::model()->findAll($q);
	}
	
	public function getTrashMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_TRASH, ':match' => '%c'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasContact($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->gender_id=0;
			$this->country_id=0;
			$this->account_id=Yii::app()->accountMgr->getAccount()->id;
			$this->create_time=$this->update_time=new CDbExpression('NOW()');
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
                'condition' => 'contact_id=:contactId',
                'params' => array(
                    ':contactId' => $this->idCache),
            ));

        $children = GroupContact::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$criteria2 = new CDbCriteria(array(
                'condition' => 'to_contact_id=:contactId',
                'params' => array(
                    ':contactId' => $this->idCache),
            ));
		$children = MailSms::model()->findAll($criteria2);

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
		return 'images/tc_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathWithExt($ext)
	{
		return 'images/c_'.$this->id.'.'.$ext;
	}
	
	public function getRawImagePathWithExt($ext)
	{
		return 'images/rc_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathIfFileExists()
	{
		$filename=$this->getImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/'.($this->id % 6 + 1).'.png';
	}
	
	public function getThumbnailImagePathIfFileExists()
	{
		$filename=$this->getThumbnailImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/'.($this->id % 6 + 1).'.png';
	}
	
	
}