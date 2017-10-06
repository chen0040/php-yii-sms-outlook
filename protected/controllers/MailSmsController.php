<?php

class MailSmsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('process', 'submitProcess'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'index','view', 
					'create',
					'update', 
					'addTask', 'submitAddTask', 
					'updateTask', 'submitUpdateTask', 
					'submitDeleteTask', 
					'compose', 
					'deleteMailSms', 'submitDeleteMailSms',
					'indexMailSmsTemplates', 'addMailSmsTemplate', 'updateMailSmsTemplate',
					'updateMailSms'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionIndexMailSmsTemplates()
	{
		$this->render('indexMailSmsTemplates',array(
			'user'=>Yii::app()->accountMgr->getAccount(),
			'url'=>$_GET['url'],
			'field_id'=>$_GET['field_id']
		));
	}
	
	public function actionAddMailSmsTemplate()
	{
		if(isset($_POST['Save']))
		{
			$model=new MailSms;
			if(isset($_POST['message_body']))
			{
				$model->message_body=$_POST['message_body'];
			}
			if(isset($_POST['template_title']))
			{
				$model->setTemplateTitle($_POST['template_title']);
			}

			$model->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
			$model->to_type=MailSms::TOTYPE_INTEGRATED;
			$model->sms_type=MailSms::TYPE_SMS;
			$model->status=MailSms::STATUS_SMS_TEMPLATE;
			
			if($model->save())
			{
				$this->redirect(array($_GET['parent_url'], 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
			}
			else
			{
				$this->redirect(array($_GET['parent_url'], 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
			}
		}
		else if(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['parent_url'], 'field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
		}
		else
		{
			$this->render('addMailSmsTemplate', array('parent_url'=>$_GET['parent_url'], 'field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
		}
		echo 'Invalid cmd';
	}
	
	public function actionUpdateMailSmsTemplate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Save']))
		{
			if(isset($_POST['message_body']))
			{
				$model->message_body=$_POST['message_body'];
			}
			if(isset($_POST['template_title']))
			{
				$model->setTemplateTitle($_POST['template_title']);
			}

			if($model->save())
			{
				$this->redirect(array($_GET['parent_url'], 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
			}
			else
			{
				$this->redirect(array($_GET['parent_url'], 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
			}
		}
		else if(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['parent_url'], 'field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
		}
		else if(isset($_POST['Delete']))
		{
			$model->delete();
			$this->redirect(array($_GET['parent_url'], 'field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
		}
		else
		{
			$this->render('updateMailSmsTemplate', array('parent_url'=>$_GET['parent_url'], 'field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'model'=>$this->loadModel($id)));
		}
		echo 'Invalid cmd';
	}
	
	public function actionCompose()
	{
		if(isset($_POST['addContact']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			//$recipient_names=$model->getFormattedRecipients();
			//$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
			$this->render('addContactToMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'model'=>$model));
		}
		else if(isset($_POST['addContactId']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			if($_POST['addContactId']!=='')
			{
				if($model->txt_field1==='')
				{
					$model->txt_field1=$_POST['addContactId'];
				}
				ELSE
				{
					$model->txt_field1.=(',c'.$_POST['addContactId']);
				}
			}
			
			$recipient_names=$model->getFormattedRecipients();
			$recipients=$model->txt_field1;
			$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
			
		}
		else if(isset($_POST['addGroup']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			//$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
			$this->render('addGroupToMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'model'=>$model));
		}
		else if(isset($_POST['addGroupId']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			if($_POST['addGroupId']!=='')
			{
				if($model->txt_field1==='')
				{
					$model->txt_field1=$_POST['addGroupId'];
				}
				ELSE
				{
					$model->txt_field1.=(',g'.$_POST['addGroupId']);
				}
			}
			
			$recipient_names=$model->getFormattedRecipients();
			$recipients=$model->txt_field1;
			$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
			
		}
		else if(isset($_POST['removeLastRep']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			$rec_array=explode(",", $recipients);
			$rec_count=count($rec_array);
			if($rec_count > 0)
			{
				$recipients='';
				for($rec_index=0; $rec_index < $rec_count-1; $rec_index++)
				{
					if($rec_index==0)
					{
						$recipients.=$rec_array[$rec_index];
					}
					else
					{
						$recipients.=(','.$rec_array[$rec_index]);
					}
				}
			}
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			$recipient_names=$model->getFormattedRecipients();
			$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
		}
		else if(isset($_POST['Save']) || isset($_POST['Send']))
		{
			$model=new MailSms;
			if(isset($_POST['message_body']))
			{
				$model->message_body=$_POST['message_body'];
			}
			if(isset($_POST['recipients']))
			{
				$model->txt_field1=$_POST['recipients'];
			}
			if(isset($_POST['send_time']))
			{
				$model->setSendTime($_POST['send_time']);
			}
			
			$model->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
			$model->to_type=MailSms::TOTYPE_INTEGRATED;
			$model->sms_type=MailSms::TYPE_SMS;
			
			if(isset($_POST['Save']))
			{
				$model->status=MailSms::STATUS_DRAFT;
			}
			else
			{
				$model->status=MailSms::STATUS_OUTBOX;
				
			}
			if($model->save())
			{
				if($model->status==MailSms::STATUS_OUTBOX)
				{
					$model->dispatchOutboxMessages();
				}
				
				$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
			}
			else
			{
				$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
			}
		}
		else if(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->render('compose', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
		}
	}
	
	public function actionProcess()
	{
		if(isset($_GET['secret']))
		{
			$user=Yii::app()->accountMgr->findAdminAccount();
			if(isset($user))
			{
				$secret = $user->getSecretPhase();
				if(isset($secret) && $secret !== '')
				{
					if($_GET['secret']===$secret)
					{
						echo '<?xml version="1.0"?>';
						
						$contact=null;
						$model = MailSms::model()->find('status=? AND dat_field3 <= NOW()', array(MailSms::STATUS_IND_OUTBOX));
						
						while(!isset($contact) && isset($model))
						{
							$contact=Contact::model()->findByPk($model->to_contact_id);
							if(!isset($contact))
							{
								$model->delete();
								$model = MailSms::model()->find('status=? AND dat_field3 <= NOW()', array(MailSms::STATUS_IND_OUTBOX));
							}
						}
						
						if(isset($model))
						{
							$fname=htmlentities($contact->first_name);
							$lname=htmlentities($contact->last_name);
							$phone=htmlentities($contact->phone1);
							$content=htmlentities($model->message_body);
							$account_id=$model->account_id;
							$username='';
							$user=Account::model()->findByPk($account_id);
							if(isset($user))
							{
								$username=$user->username;
							}
							echo '<mail status="has_stocks">';
							echo '<contact fname="'.$fname.'" lname="'.$lname.'" phone="'.$phone.'" id="'.$contact->id.'" />';
							echo '<message content="'.$content.'" id="'.$model->id.'" send_time="'.$model->getSendTime().'" />';
							echo '<account id="'.$account_id.'" username="'.$username.'" />';
							echo '</mail>';
						}
						else
						{
							echo '<mail status="no_stocks" />';
						}
						
						
					}
					else
					{
						echo '<?xml version="1.0"?>';
						echo '<mail status="invalid_access" />';
					}
				}
			}
			else
			{
				echo '<?xml version="1.0"?>';
				echo '<mail status="invalid_access" />';
			}
		}
		else
		{
			echo '<?xml version="1.0"?>';
			echo '<mail status="invalid_access" />';
		}
	}
	
	public function actionSubmitProcess($id)
	{
		if(isset($_GET['secret']))
		{
			$user=Yii::app()->accountMgr->findAdminAccount();
			if(isset($user))
			{
				$secret = $user->getSecretPhase();
				if(isset($secret) && $secret !== '')
				{
					if($_GET['secret']===$secret)
					{
						echo '<?xml version="1.0"?>';
						
						$model = MailSms::model()->findByPk($id);
						
						if(isset($model))
						{
							$model->status=MailSms::STATUS_IND_SENT;
							$model->save();
							
							$parent_model=MailSms::model()->findByPk($model->parent_sms_id);
							if(isset($parent_model))
							{
								$parent_model->updateStatus();
								
								$account_id=$model->account_id;
								$username='';
								$user=Account::model()->findByPk($account_id);
								if(isset($user))
								{
									$username=$user->username;
								}
								echo '<mail status="sent_completed">';
								echo '<message content="'.$model->message_body.'" id="'.$model->id.'" />';
								echo '<account id="'.$account_id.'" username="'.$username.'" />';
								echo '</mail>';
							}
							else
							{
								$account_id=$model->account_id;
								$username='';
								$account=Account::model()->findByPk($account_id);
								if(isset($account))
								{
									$username=$account->username;
								}
								echo '<mail status="failed_to_find_master_email">';
								echo '<message content="'.$model->message_body.'" id="'.$model->id.'" master_mail_id="'.$model->parent_sms_id.'" />';
								echo '<account id="'.$account_id.'" username="'.$username.'" />';
								echo '</mail>';
							}
						}
						else
						{
							echo '<mail status="no_stocks" />';
						}
						
						
					}
					else
					{
						echo '<?xml version="1.0"?>';
						echo '<mail status="invalid_access" />';
					}
				}
			}
			else
			{
				echo '<?xml version="1.0"?>';
				echo '<mail status="invalid_access" />';
			}
		}
		else
		{
			echo '<?xml version="1.0"?>';
			echo '<mail status="invalid_access" />';
		}
	}
	
	public function actionAddTask()
	{
		$this->render('addTask', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
	}
	
	public function actionSubmitAddTask()
	{
		$model=new MailSms;
		if(isset($_POST['task_details']))
		{
			$model->message_body=$_POST['task_details'];
		}
		if(isset($_POST['task_status']))
		{
			$model->status=$_POST['task_status'];
		}
		$model->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
		$model->to_type=MailSms::TOTYPE_NA;
		$model->sms_type=MailSms::TYPE_TASK;
		if($model->save())
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
	}
	
	
	
	public function actionSubmitDeleteTask($id)
	{
		$model=$this->loadModel($id);
		if(isset($model))
		{
			$model->delete();
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
	}
	
	public function actionDeleteMailSms($id)
	{
		$this->render('deleteMailSms', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'current_mail'=>$this->loadModel($id)));
	}
	
	public function actionSubmitDeleteMailSms($id)
	{
		$model=$this->loadModel($id);
		if(isset($model))
		{
			$model->delete();
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
	}
	
	public function actionUpdateMailSms($id)
	{
		if(isset($_POST['addContact']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			$this->render('addContactToMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'id'=>$id, 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'model'=>$model));
		}
		else if(isset($_POST['addContactId']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			if($_POST['addContactId']!=='')
			{
				if($model->txt_field1==='')
				{
					$model->txt_field1=$_POST['addContactId'];
				}
				ELSE
				{
					$model->txt_field1.=(',c'.$_POST['addContactId']);
				}
			}
			
			$recipient_names=$model->getFormattedRecipients();
			$recipients=$model->txt_field1;
			$this->render('updateMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names, 'mailSms'=>$this->loadModel($id)));
			
		}
		else if(isset($_POST['addGroup']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			//$this->render('compose', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names));
			$this->render('addGroupToMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'id'=>$id, 'message_body'=>$message_body, 'recipients'=>$recipients, 'model'=>$model));
		}
		else if(isset($_POST['addGroupId']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			
			if($_POST['addGroupId']!=='')
			{
				if($model->txt_field1==='')
				{
					$model->txt_field1=$_POST['addGroupId'];
				}
				ELSE
				{
					$model->txt_field1.=(',g'.$_POST['addGroupId']);
				}
			}
			
			$recipient_names=$model->getFormattedRecipients();
			$recipients=$model->txt_field1;
			$this->render('updateMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names, 'mailSms'=>$this->loadModel($id)));
			
		}
		else if(isset($_POST['removeLastRep']))
		{
			$send_time=$_POST['send_time'];
			$message_body=$_POST['message_body'];
			$recipients=$_POST['recipients'];
			$rec_array=explode(",", $recipients);
			$rec_count=count($rec_array);
			if($rec_count > 0)
			{
				$recipients='';
				for($rec_index=0; $rec_index < $rec_count-1; $rec_index++)
				{
					if($rec_index==0)
					{
						$recipients.=$rec_array[$rec_index];
					}
					else
					{
						$recipients.=(','.$rec_array[$rec_index]);
					}
				}
			}
			
			$model=new MailSms;
			$model->txt_field1=$recipients;
			$recipient_names=$model->getFormattedRecipients();
			$this->render('updateMailSms', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'send_time'=>$send_time, 'message_body'=>$message_body, 'recipients'=>$recipients, 'recipient_names'=>$recipient_names, 'mailSms'=>$this->loadModel($id)));
		}
		else if(isset($_POST['Send']) || isset($_POST['Save']) || isset($_POST['Trash']))
		{
			$model=$this->loadModel($id);
			if(isset($_POST['message_body']))
			{
				$model->message_body=$_POST['message_body'];
			}
			if(isset($_POST['recipients']))
			{
				$model->txt_field1=$_POST['recipients'];
			}
			if(isset($_POST['send_time']))
			{
				$model->setSendTime($_POST['send_time']);
			}
			if($model->status==MailSms::STATUS_OUTBOX)
			{
				if(isset($_POST['Send']))
				{
					$model2=new MailSms;
					$model2->message_body=$model->message_body;
					$model2->txt_field1=$model->txt_field1;
					$model2->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
					$model2->to_type=$model->to_type;
					$model2->sms_type=$model->sms_type;
					$model2->setSendTime($model->getSendTime());
					
					$model2->status=MailSms::STATUS_OUTBOX;
					
					$model=$model2;
				}
				else if(isset($_POST['Save']))
				{
					$model2=new MailSms;
					$model2->message_body=$model->message_body;
					$model2->txt_field1=$model->txt_field1;
					$model2->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
					$model2->to_type=$model->to_type;
					$model2->sms_type=$model->sms_type;
					$model2->setSendTime($model->getSendTime());
					
					$model2->status=MailSms::STATUS_DRAFT;
					
					$model=$model2;
				}
				else if(isset($_POST['Trash']))
				{
					$model->status=MailSms::STATUS_TRASH;
					
					$criteria2 = new CDbCriteria(array(
					'condition' => 'parent_sms_id=:parentId AND status = :statusId',
					'params' => array(
						':parentId' => $model->id,
						':statusId' => MailSms::STATUS_IND_OUTBOX,
						),
					));
					$children = MailSms::model()->findAll($criteria2);

					foreach ($children as $child)
					{
						$child->delete();
					}
				}
			}
			else if($model->status==MailSms::STATUS_DRAFT)
			{
				if(isset($_POST['Send']))
				{
					$model->status=MailSms::STATUS_OUTBOX;
				}
				else if(isset($_POST['Trash']))
				{
					$model->status=MailSms::STATUS_TRASH;
				}
			}
			else if($model->status==MailSms::STATUS_SENT)
			{
				if(isset($_POST['Send']))
				{
					$model2=new MailSms;
					$model2->message_body=$model->message_body;
					$model2->txt_field1=$model->txt_field1;
					$model2->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
					$model2->to_type=$model->to_type;
					$model2->sms_type=$model->sms_type;
					$model2->setSendTime($model->getSendTime());
					
					$model2->status=MailSms::STATUS_OUTBOX;
					
					$model=$model2;
				}
				else if(isset($_POST['Save']))
				{
					$model2=new MailSms;
					$model2->message_body=$model->message_body;
					$model2->txt_field1=$model->txt_field1;
					$model2->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
					$model2->to_type=$model->to_type;
					$model2->sms_type=$model->sms_type;
					$model2->setSendTime($model->getSendTime());
					
					$model2->status=MailSms::STATUS_DRAFT;
					
					$model=$model2;
				}
				else if(isset($_POST['Trash']))
				{
					$model->status=MailSms::STATUS_TRASH;
				}
			}
			else if($model->status==MailSms::STATUS_TRASH)
			{
				if(isset($_POST['Send']))
				{
					$model->status=MailSms::STATUS_OUTBOX;
				}
				else if(isset($_POST['Save']))
				{
					$model->status=MailSms::STATUS_DRAFT;
				}
			}
			
			if($model->save())
			{
				if($model->status==MailSms::STATUS_OUTBOX)
				{
					$model->clearChildMessages();
					$model->dispatchOutboxMessages();
				}
				$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
			}
			else
			{
				$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
			}
		}
		else if(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else if(isset($_POST['Delete']))
		{
			$model=$this->loadModel($id);
			$model->delete();
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->render('updateMailSms', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'mailSms'=>$this->loadModel($id)));
		}
	}

	public function actionUpdateTask()
	{
		$this->render('updateTask', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'task'=>$this->loadModel($_GET['task_id'])));
	}
	
	public function actionSubmitUpdateTask($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['task_details']))
		{
			$model->message_body=$_POST['task_details'];
		}
		if(isset($_POST['task_status']))
		{
			$model->status=$_POST['task_status'];
		}
		if($model->save())
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MailSms;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MailSms']))
		{
			$model->attributes=$_POST['MailSms'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MailSms']))
		{
			$model->attributes=$_POST['MailSms'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('MailSms');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MailSms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MailSms']))
			$model->attributes=$_GET['MailSms'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=MailSms::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mail-sms-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
