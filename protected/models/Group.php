<?php

/**
 * This is the model class for table "vsms_group".
 *
 * The followings are the available columns in table 'vsms_group':
 * @property integer $id
 * @property string $groupname
 * @property string $description
 * @property integer $account_id
 * @property string $org_name
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
class Group extends CActiveRecord
{
	private $idCache;
	const CLASS_NAME='Group';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return 'vsms_group';
	}
	
	public function getClassName()
	{
		return Group::CLASS_NAME;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, int_field1, int_field2', 'numerical', 'integerOnly'=>true),
			array('dbl_field1, dbl_field2', 'numerical'),
			array('groupname, org_name, varc_field1, varc_field2', 'length', 'max'=>255),
			array('description, txt_field1, txt_field2, dat_field1, dat_field2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, groupname, description, account_id, org_name, int_field1, int_field2, dbl_field1, dbl_field2, varc_field1, varc_field2, txt_field1, txt_field2, dat_field1, dat_field2', 'safe', 'on'=>'search'),
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
			'groupname' => 'Groupname',
			'description' => 'Description',
			'account_id' => 'Account',
			'org_name' => 'Org Name',
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
		$criteria->compare('groupname',$this->groupname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('org_name',$this->org_name,true);
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
	
	public function getContactCount()
	{
		$count=GroupContact::model()->count("group_id=:groupId", array("groupId" => $this->id));
		return $count;
	}
	
	public function getContacts()
	{
		$contacts=array();
		$group_contacts=GroupContact::model()->findAll("group_id=:groupId", array("groupId"=>$this->id));
		foreach($group_contacts as $gc)
		{
			$contact_id=$gc->contact_id;
			$contacts[]=Contact::model()->findByPk($contact_id);
		}
		return $contacts;
	}
	
	public function getOutboxMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_OUTBOX, ':match' => '%g'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasGroup($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function getDraftMails()
	{
		
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_DRAFT, ':match' => '%g'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasGroup($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function getSentMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_SENT, ':match' => '%g'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasGroup($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function getTrashMails()
	{
		$q = new CDbCriteria( array(
			'condition' => "account_id=:accountId AND status=:statusId AND txt_field1 LIKE :match",      
			'params'    => array(':accountId'=>Yii::app()->accountMgr->getAccount()->id, ':statusId'=>MailSms::STATUS_TRASH, ':match' => '%g'.$this->id.'%')
		) );

		$mails = MailSms::model()->findAll($q);
		$act_mails=array();
		foreach($mails as $mail)
		{
			if($mail->hasGroup($this))
			{
				$act_mails[]=$mail;
			}
		}
		return $act_mails;
	}
	
	public function hasContact($contact)
	{
		$count=GroupContact::model()->count("group_id=:groupId AND contact_id=:contactId", array("groupId"=>$this->id, "contactId"=>$contact->id));
		return $count != 0;
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->account_id=Yii::app()->accountMgr->getAccount()->id;
			$this->dat_field2=$this->dat_field1=new CDbExpression('NOW()');
		}
		else
		{
			$this->dat_field2=new CDbExpression('NOW()'); 
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
                'condition' => 'group_id=:groupId',
                'params' => array(
                    ':groupId' => $this->idCache),
            ));

        $children = GroupContact::model()->findAll($criteria);

        foreach ($children as $child)
        {
            $child->delete();
        }
		
		$criteria2 = new CDbCriteria(array(
                'condition' => 'to_group_id=:groupId',
                'params' => array(
                    ':groupId' => $this->idCache),
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
		return 'images/tg_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathWithExt($ext)
	{
		return 'images/g_'.$this->id.'.'.$ext;
	}
	
	public function getRawImagePathWithExt($ext)
	{
		return 'images/rg_'.$this->id.'.'.$ext;
	}
	
	public function getImagePathIfFileExists()
	{
		$filename=$this->getImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/g'.($this->id % 6 + 1).'.png';
	}
	
	public function getThumbnailImagePathIfFileExists()
	{
		$filename=$this->getThumbnailImagePath();
		if(file_exists($filename))
		{
			return $filename;
		}
		return 'images/g'.($this->id % 6 + 1).'.png';
	}
	
	public function getPrevGroupId($id)
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'id < :groupId AND account_id = :accountId',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id DESC',
				'limit' => 1,
            ));

        $children = Group::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
	
	public function getNextGroupId($id)
	{
		$criteria = new CDbCriteria(array(
                'condition' => 'id > :groupId AND account_id = :accountId',
                'params' => array(
                    ':groupId' => $id,
					':accountId' => Yii::app()->accountMgr->getAccount()->id),
				'order' => 'id ASC',
				'limit' => 1,
            ));

        $children = Group::model()->findAll($criteria);
		if(count($children)==0)
		{
			return $id;
		}
		return $children[0]->id;
	}
}