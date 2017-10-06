<?php

/**
 * This is the model class for table "vsms_mail_sms".
 *
 * The followings are the available columns in table 'vsms_mail_sms':
 * @property integer $id
 * @property integer $group_id
 * @property integer $status
 * @property integer $account_id
 * @property integer $to_group_id
 * @property integer $to_contact_id
 * @property integer $to_type
 * @property integer $sms_type
 * @property string $message_body
 * @property integer $parent_sms_id
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
 * @property string $dat_field3
 * @property string $dat_field4
 * @property string $dat_field5
 */
class MailSms extends CActiveRecord
{
	const STATUS_OUTBOX=0;
	const STATUS_SENT=1;
	const STATUS_DRAFT=2;
	const STATUS_TRASH=3;
	const STATUS_IND_OUTBOX=4;
	const STATUS_IND_SENT=5;
	const STATUS_IND_DRAFT=6;
	const STATUS_IND_TRASH=7;
	const STATUS_TASK_ACTIVE=8;
	const STATUS_TASK_COMPLETED=9;
	const STATUS_TASK_INACTIVE=10;
	const STATUS_SMS_TEMPLATE=11;
	
	const TYPE_NA=0;
	const TYPE_TASK=1;
	const TYPE_SMS=2;
	const TYPE_EMAIL=3;
	
	const TOTYPE_NA=0;
	const TOTYPE_GROUP=1;
	const TOTYPE_CONTACT=2;
	const TOTYPE_INTEGRATED=3;
	
	const PARENT_SMS_ID_NA=-1;
	
	private $idCache;
	
	//dat_field1 is the create time
	//dat_field2 is the update time
	//dat_field3 is the send time
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MailSms the static model class
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
		return 'vsms_mail_sms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, status, account_id, to_group_id, to_contact_id, to_type, sms_type, parent_sms_id, int_field1, int_field2', 'numerical', 'integerOnly'=>true),
			array('dbl_field1, dbl_field2', 'numerical'),
			array('org_name, varc_field1, varc_field2', 'length', 'max'=>255),
			array('message_body, txt_field1, txt_field2, dat_field1, dat_field2, dat_field3, dat_field4, dat_field5', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, status, account_id, to_group_id, to_contact_id, to_type, sms_type, message_body, parent_sms_id, org_name, int_field1, int_field2, dbl_field1, dbl_field2, varc_field1, varc_field2, txt_field1, txt_field2, dat_field1, dat_field2, dat_field3, dat_field4, dat_field5', 'safe', 'on'=>'search'),
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
	
	public function getDateFromTime($time_dat)
	{
		$time_array=explode(" ", $time_dat);
		if(count($time_array) > 0)
		{
			return $time_array[0];
		}
		return null;
	}
	
	public function getSendTime()
	{
		if(isset($this->dat_field3) && $this->dat_field3 !== '')
		{
			return $this->dat_field3;
		}
		else
		{
			return $this->dat_field2;
		}
	}
	
	public function getSendDate()
	{
		return $this->getDateFromTime($this->getSendTime());
	}
	
	public function getUpdateTime()
	{
		return $this->dat_field2;
	}
	
	public function getCreateTime()
	{
		return $this->dat_field1;
	}
	
	public function getUpdateDate()
	{
		return $this->getDateFromTime($this->getUpdateTime());
	}
	
	public function getCreateDate()
	{
		return $this->getDateFromTime($this->getCreateTime());
	}
	
	public function setSendTime($sentTime)
	{
		$this->dat_field3=$sentTime;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'status' => 'Status',
			'account_id' => 'Account',
			'to_group_id' => 'To Group',
			'to_contact_id' => 'To Contact',
			'to_type' => 'To Type',
			'sms_type' => 'Sms Type',
			'message_body' => 'Message Body',
			'parent_sms_id' => 'Parent Sms',
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
			'dat_field3' => 'Dat Field3',
			'dat_field4' => 'Dat Field4',
			'dat_field5' => 'Dat Field5',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('to_group_id',$this->to_group_id);
		$criteria->compare('to_contact_id',$this->to_contact_id);
		$criteria->compare('to_type',$this->to_type);
		$criteria->compare('sms_type',$this->sms_type);
		$criteria->compare('message_body',$this->message_body,true);
		$criteria->compare('parent_sms_id',$this->parent_sms_id);
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
		$criteria->compare('dat_field3',$this->dat_field3,true);
		$criteria->compare('dat_field4',$this->dat_field4,true);
		$criteria->compare('dat_field5',$this->dat_field5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->account_id=Yii::app()->accountMgr->getAccount()->id;
			$this->dat_field1=$this->dat_field2=new CDbExpression('NOW()');
		}
		else
		{
			$this->dat_field2=new CDbExpression('NOW()'); 
		}
		return TRUE;
	}
	
	public function dispatchOutboxMessages()
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$contact_id_array=array();
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='g') //group
			{
				$gc_groups = GroupContact::model()->findAll('group_id=?', array($rec_id));
				foreach($gc_groups as $gc)
				{
					$contact_id_array[$gc->contact_id]='';
				}
			}
			else if($rec_type==='c')
			{
				$contact_id_array[$rec_id]='';
			}
		}
		
		foreach($contact_id_array as $contact_id => $val)
		{
			$count = Contact::model()->count('id=?', array($contact_id));
			if($count == 0)
			{
				continue;
			}
			$model=new MailSms;
			$model->message_body=$this->message_body;
			$model->txt_field1=$this->txt_field1;
			$model->to_contact_id=$contact_id;
			$model->parent_sms_id=$this->id;
			$model->to_type=MailSms::TOTYPE_CONTACT;
			$model->sms_type=MailSms::TYPE_SMS;
			$model->status=MailSms::STATUS_IND_OUTBOX;
			$model->setSendTime($this->getSendTime());
			$model->save();
		}
	}
	
	public function getGroups()
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$groups=array();
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='g') //group
			{
				$group = Group::model()->findByPk($rec_id);
				if(isset($group))
				{
					$groups[]= $group;
				}
			}
		}
		
		return $groups;
	}
	
	public function hasGroup($current_group)
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$groups=array();
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='g' && $rec_id==$current_group->id) //group
			{
				return true;
			}
		}
		
		return false;
	}
	
	public function getFormattedRecipients2()
	{
		$message_recipients='';
		$groups=$this->getGroups();
		$contacts=$this->getContacts();
		
		foreach($groups as $group)
		{
			if($message_recipients!=='')
			{
				$message_recipients .= ', ';
			}
			$message_recipients .= '+'.$group->groupname.'';
		}
		
		$contact_count=count($contacts);
		for($ci=0; $ci < $contact_count; ++$ci)
		{
			if($message_recipients!=='')
			{
				$message_recipients .= ', ';
			}
			$contact=$contacts[$ci];
			$message_recipients .= ''.$contact->first_name.' '.$contact->last_name;
		}
		
		return $message_recipients;
	}
	
	public function getFormattedRecipients()
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$message_recipients='';
		
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='c')
			{
				$contact=Contact::model()->findByPk($rec_id);
				if(isset($contact))
				{
					if($message_recipients!=='')
					{
						$message_recipients .= ', ';
					}
					$message_recipients .= ''.$contact->first_name.' '.$contact->last_name;
				}
			}
			else if($rec_type==='g')
			{
				$group=Group::model()->findByPk($rec_id);
				if(isset($group))
				{
					if($message_recipients!=='')
					{
						$message_recipients .= ', ';
					}
					$message_recipients .= '+'.$group->groupname.'';
				}
			}
		}
		return $message_recipients;
	}
	
	public function getGroupNames()
	{
		$message_recipients='';
		$groups=$this->getGroups();
		
		foreach($groups as $group)
		{
			if($message_recipients!=='')
			{
				$message_recipients .= ', ';
			}
			$message_recipients .= ''.$group->groupname.'';
		}
		
		return $message_recipients;
	}
	
	public function getContacts()
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$contacts=array();
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='c')
			{
				$contact=Contact::model()->findByPk($rec_id);
				if(isset($contact))
				{
					$contacts []= $contact;
				}
			}
		}
		return $contacts;
	}
	
	public function getRecipients()
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		$contacts=array();
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='c')
			{
				$contact=Contact::model()->findByPk($rec_id);
				if(isset($contact))
				{
					$contacts []= $contact;
				}
			}
			else if($rec_type==='g')
			{
				$group=Group::model()->findByPk($rec_id);
				if(isset($group))
				{
					$contacts[]=$group;
				}
			}
		}
		return $contacts;
	}
	
	public function hasContact($current_contact)
	{
		$recipients=$this->txt_field1;
		$recipient_array=explode(",", $recipients);
		
		foreach($recipient_array as $recipient)
		{
			$rec_data = trim($recipient);
			if(strlen($rec_data) < 2)
			{
				continue;
			}
			$rec_type = substr($rec_data, 0, 1);
			$rec_id = substr($rec_data, 1, strlen($rec_data)-1);
			if($rec_type==='c' && $rec_id==$current_contact->id)
			{
				return true;
			}
		}
		return false;
	}
	
	public function beforeDelete()
    {
        $this->idCache = $this->id;

        return parent::beforeDelete();
    }

    public function afterDelete()
    {		
		$criteria2 = new CDbCriteria(array(
                'condition' => 'parent_sms_id=:parentId',
                'params' => array(
                    ':parentId' => $this->idCache),
            ));
		$children = MailSms::model()->findAll($criteria2);

        foreach ($children as $child)
        {
            $child->delete();
        }

        parent::afterDelete();
    }
	
	public function clearChildMessages()
	{
		$criteria2 = new CDbCriteria(array(
                'condition' => 'parent_sms_id=:parentId',
                'params' => array(
                    ':parentId' => $this->id),
            ));
		$children = MailSms::model()->findAll($criteria2);

        foreach ($children as $child)
        {
            $child->delete();
        }
	}
	
	public function updateStatus()
	{
		if($this->status==MailSms::STATUS_OUTBOX)
		{
			$count=$this->getOutBoxMessageCount();
			if($count==0)
			{
				$this->status=MailSms::STATUS_SENT;
				$this->save();
			}
		}
	}
	
	public function getOutBoxMessageCount()
	{
		$criteria2 = new CDbCriteria(array(
		'condition' => 'parent_sms_id=:parentId AND status = :statusId',
		'params' => array(
			':parentId' => $this->id,
			':statusId' => MailSms::STATUS_IND_OUTBOX,
			),
		));
		$count = MailSms::model()->count($criteria2);
	
		return $count;
	}
	
	public function getSentMessageCount()
	{
		$criteria2 = new CDbCriteria(array(
		'condition' => 'parent_sms_id=:parentId AND status = :statusId',
		'params' => array(
			':parentId' => $this->id,
			':statusId' => MailSms::STATUS_IND_SENT,
			),
		));
		$count = MailSms::model()->count($criteria2);
	
		return $count;
	}
	
	public function getOutBoxMessages()
	{
		$criteria2 = new CDbCriteria(array(
		'condition' => 'parent_sms_id=:parentId AND status = :statusId',
		'params' => array(
			':parentId' => $this->id,
			':statusId' => MailSms::STATUS_IND_OUTBOX,
			),
		));
		return MailSms::model()->findAll($criteria2);
	}
	
	public function getSentMessages()
	{
		$criteria2 = new CDbCriteria(array(
		'condition' => 'parent_sms_id=:parentId AND status = :statusId',
		'params' => array(
			':parentId' => $this->id,
			':statusId' => MailSms::STATUS_IND_SENT,
			),
		));
		return MailSms::model()->findAll($criteria2);
	}
	
	public function getRecipientName()
	{
		$contact=Contact::Model()->findByPk($this->to_contact_id);
		if(isset($contact))
		{
			return $contact->first_name.' '.$contact->last_name;
		}
		return 'NA';
	}
	
	public function getTemplateTitle()
	{
		return $this->varc_field1;
	}
	
	public function setTemplateTitle($title)
	{
		$this->varc_field1=$title;
	}
	
}