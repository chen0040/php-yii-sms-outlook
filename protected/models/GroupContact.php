<?php

/**
 * This is the model class for table "vsms_group_contact".
 *
 * The followings are the available columns in table 'vsms_group_contact':
 * @property integer $id
 * @property integer $group_id
 * @property integer $contact_id
 * @property integer $account_id
 * @property string $description
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
class GroupContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupContact the static model class
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
		return 'vsms_group_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, contact_id, account_id, int_field1, int_field2', 'numerical', 'integerOnly'=>true),
			array('dbl_field1, dbl_field2', 'numerical'),
			array('org_name, varc_field1, varc_field2', 'length', 'max'=>255),
			array('description, txt_field1, txt_field2, dat_field1, dat_field2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, contact_id, account_id, description, org_name, int_field1, int_field2, dbl_field1, dbl_field2, varc_field1, varc_field2, txt_field1, txt_field2, dat_field1, dat_field2', 'safe', 'on'=>'search'),
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
			'group_id' => 'Group',
			'contact_id' => 'Contact',
			'account_id' => 'Account',
			'description' => 'Description',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('description',$this->description,true);
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
}