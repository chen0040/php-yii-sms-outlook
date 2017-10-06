<?php

class AccountController extends Controller
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
				'actions'=>array('signup', 'submitSignup', 'autoBackup', 'login', 'loginFailed', 'signup'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('clearData', 
					'submitClearData', 
					'importData', 
					'exportData', 
					'submitImportData', 
					'exportContacts', 
					'exportMessages', 
					'showChart', 'showCharts', 
					'showTasks', 'showTask',
					'changePassword', 'submitChangePassword', 
					'changeLanguage',
					'changeTheme', 'submitChangeTheme'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'addAccount', 'submitAddAccount', 'index', 'view', 'create','update', 'submitUpdate', 'submitDeleteAccount', 'changeSCWord', 'submitChangeSCWord', 'backup'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionAutoBackup()
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
						
						$account_id=$user->id;
						$username=$user->username;
							
						echo '<backup status="backup_succeed">';
						echo '<backup_detail time="'.date('Y-M-d H:i:s').'" />';
						echo '<account id="'.$account_id.'" username="'.$username.'" />';
						echo '</backup>';
						
						Yii::import('ext.yii-database-dumper.SDatabaseDumper');
						$dumper = new SDatabaseDumper;
						 
						// Get path to new backup file
						$file = Yii::getPathOfAlias('webroot.protected.backups').'/dump'.$date('Y-M-d-H-i-s').'.sql';
						 
						 /*
						// Gzip dump
						if(function_exists('gzencode'))
						{
							$file.='.gz';
							file_put_contents($file, gzencode($dumper->getDump()));
						}
						else
						{
							file_put_contents($file, $dumper->getDump());
						}	*/
						file_put_contents($file, $dumper->getDump());
					}
					else
					{
						echo '<?xml version="1.0"?>';
						echo '<backup status="invalid_access" />';
					}
				}
			}
			else
			{
				echo '<?xml version="1.0"?>';
				echo '<backup status="invalid_access" />';
			}
		}
		else
		{
			echo '<?xml version="1.0"?>';
			echo '<backup status="invalid_access" />';
		}
	}
	
	public function actionChangeLanguage($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Change']))
		{
			$model->setLanguage($_POST['language']);
			$model->save();
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->render('changeLanguage', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$this->loadModel($id)));
		}
	}
	
	
	public function actionBackup()
	{
		Yii::import('ext.yii-database-dumper.SDatabaseDumper');
		$dumper = new SDatabaseDumper;
		 
		// Get path to new backup file
		$file = Yii::getPathOfAlias('webroot.protected.backups').'/dump.sql';
		 
		 /*
		// Gzip dump
		if(function_exists('gzencode'))
		{
			$file.='.gz';
			file_put_contents($file, gzencode($dumper->getDump()));
		}
		else
		{
			file_put_contents($file, $dumper->getDump());
		}	*/
		file_put_contents($file, $dumper->getDump());
		
		$this->renderPartial('backup', array(
			'filename'=>$file
		), false, false);
	}
	
	public function actionSignup()
	{
		$this->render('signup', array('url'=>$_GET['url']));
	}
	
	public function actionSubmitSignup()
	{
		if(isset($_POST['Signup']))
		{
			spl_autoload_unregister(array('YiiBase','autoload')); //required when incorporating third party lib
			require_once Yii::app()->basePath.'/extensions/PHPMailer/class.phpmailer.php';
			//require_once Yii::app()->basePath.'/extensions/PHPMailer/languages/phpmailer.lang-en.php';
			require_once Yii::app()->basePath.'/extensions/PHPMailer/class.smtp.php';
			spl_autoload_register(array('YiiBase','autoload')); //required when incorporating third party lib
			
			//in you php.ini make sure you have uncommented the line with
			//extension=php_openssl.dll
			
			$message='Incoming signup request, details below:<br />';
			$message.='<table>';
			$message.='<tr><td><b>First Name:</b></td><td>'.$_POST['firstName'].'</td></tr>';
			$message.='<tr><td><b>Last Name:</b></td><td>'.$_POST['lastName'].'</td></tr>';
			$message.='<tr><td><b>Contact Email:</b></td><td>'.$_POST['email'].'</td></tr>';
			$message.='<tr><td><b>Contact Number:</b></td><td>'.$_POST['phone'].'</td></tr>';
			$message.='<tr><td colspan="2"><b>Comments:</b></td></tr>';
			$message.='<tr><td colspan="2">'.$_POST['description'].'</td></tr>';
			$message.='</table>';
			$subject='MnM SMS Organizer Signup Request';
			$to=Account::ACCTO;
			$from=Account::ACCFROM;
			
			$this->smtpmailer($to, $from, 'Webmaster', $subject, $message);
			$this->redirect(array($_GET['url']));
		}
		else
		{
			echo 'Email not Sent';
		}
	}
	
	private function smtpmailer($to, $from, $from_name, $subject, $body) 
	{ 
		//must remember to enable php openssl extension
		global $error;
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = Account::ACCUSER;
		$mail->Password = Account::ACCPWD;
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->IsHTML(true);
		$mail->AddAddress($to);
		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			return false;
		} else {
			$error = 'Message sent!';
			return true;
		}
	}
	
	public function actionExportContacts($id)
	{
		$filename='download/'.$id.'_contacts'.uniqid().'.csv';
		
		$fh = fopen($filename, 'w') or die("can't open file");
		
		$gc_list = GroupContact::model()->findAll();
		foreach($gc_list as $gc)
		{
			$contact_id=$gc->contact_id;
			$group_id=$gc->group_id;
			$group=Group::model()->findByPk($group_id);
			$contact=Contact::model()->findByPk($contact_id);
			if(isset($group) && isset($contact))
			{
				$first_name=$contact->first_name;
				$last_name=$contact->last_name;
				$email=$contact->getEmail();
				$org=$contact->getOrg();
				$ethnic_group=$contact->getEthnicGroup();
				$dob=$contact->getDOB();
				$gender='Male';
				if($contact->isFemale())
				{
					$gender='Female';
				}
				$phone=$contact->phone1;
				
				$groupname=$group->groupname;
				
				
				$record='"'.$first_name.'","'.$phone.'","'.$groupname.'", "'.$dob.'", "'.$last_name.'", "'.$email.'", "'.$org.'", "'.$ethnic_group.'", "'.$gender.'"'."\r\n";
				fwrite($fh, $record);
			}
		}
		
		fclose($fh);
		
		$this->renderPartial('exportContacts', array(
			'filename'=>$filename
		), false, false);
	}
	
	public function actionExportMessages($id)
	{
		$filename='download/'.$id.'_messages'.uniqid().'_'.$_GET['status'].'.csv';
		
		$fh = fopen($filename, 'w') or die("can't open file");
		
		$sms_list = MailSms::model()->findAll('account_id=? AND status=?', array($id, $_GET['status']));
		foreach($sms_list as $sms)
		{
			$names=$sms->getGroupNames();
			if($names==='')
			{
				continue;
			}
			$content=$sms->message_body;
			$send_date=$sms->getSendTime();
			$record='"'.$send_date.'","'.$content.'","'.$names.'"'."\r\n";
			fwrite($fh, $record);
		}
		
		fclose($fh);
		
		$this->renderPartial('exportMessages', array(
			'filename'=>$filename
		), false, false);
	}
	
	public function actionSubmitDeleteAccount($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
	}
	
	public function actionAddAccount()
	{
		$this->render('addAccount', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
	}
	
	public function actionClearData($id)
	{
		$this->render('clearData', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'model'=>$this->loadModel($id)));
	}
	
	public function actionImportData()
	{
		$this->render('importData', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
	}
	
	public function actionSubmitImportData($id)
	{
		$model=$this->loadModel($id);
		
		$sms_to=MailSms::STATUS_DRAFT;
		
		if(isset($_POST['sms_to']))
		{
			$sms_to=$_POST['sms_to'];
			if($sms_to != MailSms::STATUS_DRAFT && $sms_to != MailSms::STATUS_OUTBOX)
			{
				$sms_to=MailSms::STATUS_DRAFT;
			}
		}
		
		$contact_filename='upload/'.$id.'_contacts'.uniqid().'.csv';
		$message_filename='upload/'.$id.'_messages'.uniqid().'.csv';
		
		$error1=$this->saveUpload('importContacts', $model, $contact_filename);
		$error2=$this->saveUpload('importMessages', $model, $message_filename);
		
		$account_id=Yii::app()->accountMgr->getAccount()->id;
		
		if(file_exists($contact_filename))
		{
			$file = fopen($contact_filename,"r");
			$first_line=true;
			while(! feof($file))
			{
			  $record=fgetcsv($file);
			  if($first_line)
			  {
				$first_line=false;
				continue;
			  }
			  $record_length = count($record);
			  $contact=null;
			  if($record_length==3)
			  {
				$first_name=$record[0];
				$phone=$record[1];
				$groupname=$record[2];
				$contact=Contact::model()->find('first_name=? AND account_id=?', array($first_name, $account_id));
				if(!isset($contact))
				{
					$contact=new Contact;
					$contact->first_name=$first_name;
					$contact->phone1=$phone;
					$contact->save();
				}
				$group=Group::model()->find('groupname=? AND account_id=?', array($groupname, $account_id));
				if(!isset($group))
				{
					$group=new Group;
					$group->groupname=$groupname;
					$group->save();
				}
				$gc=GroupContact::model()->find('group_id=? AND contact_id =? AND account_id=?', array($group->id, $contact->id, $account_id));
				if(!isset($gc))
				{
					$gc=new GroupContact;
					$gc->group_id=$group->id;
					$gc->contact_id=$contact->id;
					$gc->save();
				}
			  }
			  else if($record_length == 9)
			  {
				$first_name=$record[0];
				$phone=$record[1];
				$groupname=$record[2];
				$dob=$record[3];
				$last_name=$record[4];
				$email=$record[5];
				$organization=$record[6];
				$ethnic_group=$record[7];
				$gender=$record[8];
				
				$contact=Contact::model()->find('first_name=? AND last_name=? AND account_id=?', array($first_name, $last_name, $account_id));
				
				if(!isset($contact))
				{
					$contact=new Contact;
					$contact->first_name=$first_name;
					$contact->phone1=$phone;
					$contact->setDOB($dob);
					$contact->last_name=$last_name;
					$contact->setEmail($email);
					$contact->setEthnicGroup($ethnic_group);
					$contact->setOrg($organization);
					if(strcmp($gender, "Male")==0)
					{
						$contact->setMale();
					}
					else
					{
						$contact->setFemale();
					}
					$contact->save();
				}
				
				$group=Group::model()->find('groupname=? AND account_id=?', array($groupname, $account_id));
				if(!isset($group))
				{
					$group=new Group;
					$group->groupname=$groupname;
					$group->save();
				}
				$gc=GroupContact::model()->find('group_id=? AND contact_id =? AND account_id=?', array($group->id, $contact->id, $account_id));
				if(!isset($gc))
				{
					$gc=new GroupContact;
					$gc->group_id=$group->id;
					$gc->contact_id=$contact->id;
					$gc->save();
				}
			  }
			}
			fclose($file);
		}
		
		if(file_exists($message_filename))
		{
			$file = fopen($message_filename,"r");
			$first_line=true;
			while(! feof($file))
			{
			  $record=fgetcsv($file);
			  if($first_line)
			  {
				$first_line=false;
				continue;
			  }
			  $record_length = count($record);
			 
			  if($record_length>=3)
			  {
				$send_time=$record[0];
				$content=$record[1];
				$groupnames=$record[2];
				$groupname_array=explode(",", $groupnames);

				$group_id_array=array();
				foreach($groupname_array as $groupname_entry)
				{
					$groupname=trim($groupname_entry);
					$group=Group::model()->find('groupname=? AND account_id=?', array($groupname, $account_id));
					if(isset($group))
					{
						$group_id_array[]='g'.$group->id;
					}
				}
				
				$group_string='';
				$group_count=count($group_id_array);
				for($group_id=0; $group_id < $group_count; ++$group_id)
				{
					if($group_id!=0)
					{
						$group_string.=',';
					}
					$group_string.=$group_id_array[$group_id];
				}
				if($group_string !== '')
				{
					$new_message=new MailSms;
					$new_message->message_body=$content;
					$new_message->txt_field1=$group_string;
					$new_message->setSendTime($send_time);
					
					$new_message->parent_sms_id=MailSms::PARENT_SMS_ID_NA;
					$new_message->to_type=MailSms::TOTYPE_INTEGRATED;
					$new_message->sms_type=MailSms::TYPE_SMS;
					$new_message->status=$sms_to;
					
					$new_message->save();
					if($new_message->status==MailSms::STATUS_OUTBOX)
					{
						$new_message->dispatchOutboxMessages();
					}
				}
			  }
			}
			fclose($file);
		}
		
		/*
		if(file_exists($contact_filename))
		{
			//chmod($contact_filename, 0777); 
			unlink($contact_filename);
		}
		if(file_exists($message_filename))
		{
			//chmod($message_filename, 0777); 
			unlink($message_filename);
		}*/
		
		$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
	}
	
	private function saveUpload($file_field_id, $model, $filename)
	{		
		$allowedExts = array("csv");
		$extension = end(explode(".", $_FILES[$file_field_id]["name"]));
		if(in_array($extension, $allowedExts))
		{
			if ($_FILES[$file_field_id]["error"] > 0)
			{
				return $_FILES[$file_field_id]["error"];
			}
			else
			{
				//echo "Upload: " . $_FILES[$file_field_id]["name"] . "<br />";
				//echo "Type: " . $_FILES[$file_field_id]["type"] . "<br />";
				//echo "Size: " . ($_FILES[$file_field_id]["size"] / 1024) . " Kb<br />";
				//echo "Temp file: " . $_FILES[$file_field_id]["tmp_name"] . "<br />";
				
				if (file_exists($filename))
				{
					unlink($filename);
				}
				
				move_uploaded_file($_FILES[$file_field_id]["tmp_name"],	$filename);
				//echo "Stored in: " . "upload/" . $filename;
				return null;
			}
		}
		else
		{
			return "Invalid file";
		}
	}
	
	public function actionExportData()
	{
		$this->render('exportData', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url']));
	}
	
	public function actionSubmitClearData($id)
	{
		$model=$this->loadModel($id);
		
		if(isset($_POST['data_type']))
		{
			$data_type=$_POST['data_type'];
		
			if($data_type==1)
			{
				$model->clearOutboxMails();
			}
			else if($data_type==2)
			{
				$model->clearSentMails();
			}
			else if($data_type==3)
			{
				$model->clearDraftMails();
			}
			else if($data_type==4)
			{
				$model->clearTrashMails();
			}
			else if($data_type==5)
			{
				$model->clearContacts();
			}
			else if($data_type==6)
			{
				$model->clearGroups();
			}
			else if($data_type==7)
			{
				$model->clearTasks();
			}
		}
		
		
		$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
	}
	
	public function actionSubmitAddAccount()
	{
		$model=new Account;
		
		if(isset($_POST['username']))
		{
			$model->username=$_POST['username'];
		}
		if(isset($_POST['password']))
		{
			$model->password=$_POST['password'];
		}
		if(isset($_POST['secret']))
		{
			$model->setSecretPhase($_POST['secret']);
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
	
	public function actionChangeSCWord($id)
	{
		$this->render('changeSCWord', array('field_id'=>$_GET['field_id'], 'url'=>$_GET['url'], 'model'=>$this->loadModel($id)));
	}
	
	public function actionSubmitChangeSCWord($id)
	{
		$model=$this->loadModel($id);
		

		if(isset($_POST['password']))
		{
			$model->setSecretPhase($_POST['password']);
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			$orig_password=$model->password;
			
			if($model->save())
			{
				$identity=new UserIdentity($model->username,$orig_password);
				
                $identity->authenticate();
				
				if($identity->errorCode===UserIdentity::ERROR_NONE)
				{
					$duration=0; //3600*24*30 // 30 days
					Yii::app()->user->login($identity, $duration);
				
					$this->redirect(array('site/index'));
				}
				else
				{
					$this->redirect(array('view', 'id'=>$model->id));
				}
			}
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

		$this->render('update',array('model'=>$model, 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
	}
	
	public function actionSubmitUpdate($id)
	{
		$model=$this->loadModel($id);
		
		if(isset($_POST['UpdateAccount']))
		{
			if(isset($_POST['secret']))
			{
				$model->setSecretPhase($_POST['secret']);
			}
			
			if(isset($_POST['credit']))
			{
				$model->setCredit($_POST['credit']);
			}
			
			if(isset($_POST['expiryDate']))
			{
				$model->setExpiryDate($_POST['expiryDate']);
			}
			
			if(isset($_POST['username']))
			{
				$model->username=$_POST['username'];
			}
			if(isset($_POST['password']))
			{
				$model->password=$model->encrypt($_POST['password']);
			}
		}
		elseif(isset($_POST['ActivateAccount']))
		{
			$model->activate();
		}
		elseif(isset($_POST['SuspendAccount']))
		{
			$model->suspend();
		}
		elseif(isset($_POST['ClearFailedLogins']))
		{
			$model->clearFailedLoginIPForLastHour();
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
		$this->render('index', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

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
		$model=Account::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdatePartial($id)
	{
		$model=$this->loadModel($id);

		$success_msg='success';
		$failure_msg='failure';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['partial_password']))
		{
			$pass=trim($_POST['partial_password']);
			if($pass==='')
			{
				echo 'Invalid Input!';
			}
			else
			{
				$model->password=$model->encrypt($pass);
				
				if($model->save())
				{
					echo $success_msg;
				}
			}
		}
		else if(isset($_POST['partial_first_name']) && isset($_POST['partial_last_name']))
		{
			$first_name=trim($_POST['partial_first_name']);
			$last_name=trim($_POST['partial_last_name']);
			$model->first_name=$first_name;
			$model->last_name=$last_name;
			if($model->save())
			{
				echo $model->first_name.' '.$model->last_name;
			}
			else
			{
				echo $failure_msg;
			}
		}
		else if(isset($_POST['partial_localization']))
		{
			$localization=trim($_POST['partial_localization']);
			$app = Yii::app();
			$app->language=$localization;
			$app->session['_lang'] = $localization;
			$model->setLocalization($localization);
			if($model->save())
			{
				echo '{"status":"'.$success_msg.'", "partial_localization":"'.$model->getLocalization().'"}';
			}
			else
			{
				echo '{"status":"'.$failure_msg.'", "error":"failed to save"}';
			}
		}
		else if(isset($_POST['partial_email1']))
		{
			$email1=trim($_POST['partial_email1']);
			$model->email1=$email1;
			if($model->save())
			{
				echo '{"email1":"'.$model->email1.'"}';
			}
			else
			{
				echo $failure_msg;
			}
		}
		else if(isset($_POST['partial_phone1']))
		{
			$phone1=trim($_POST['partial_phone1']);
			$model->phone1=$phone1;
			if($model->save())
			{
				echo '{"phone1":"'.$model->phone1.'"}';
			}
			else
			{
				echo $failure_msg;
			}
		}
		else
		{
			echo 'irrelavant call! id='.$id;
			foreach($_POST as $key => $value)
			{
				echo $key.'='.$value.';';
			}
		}
	}
	
	public function actionSubmitChangePassword($id)
	{
		if(isset($_POST['password']) && isset($_POST['passwordRepeat']))
		{
			$pass=$_POST['password'];
			$passRepeat=$_POST['passwordRepeat'];
			
			if($pass !== '' && $pass===$passRepeat)
			{
				$model=$this->loadModel($id);
				$model->password=$model->encrypt($pass);
				if($model->save())
				{
					$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
				}
			}
		}
		$this->redirect(array('site/index'));
	}
	
	public function actionLoginFailed()
	{
		$this->render('loginFailed', array('url'=>$_GET['url'], 'error'=>$_GET['error']));
	}
	
	public function actionShowChart()
	{
		Yii::app()->jqGraph->createGraph('', '');
	}
	
	public function actionShowCharts($id)
	{
		$this->render('showCharts', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$this->loadModel($id)));
	}
	
	public function actionChangePassword($id)
	{
		$this->render('changePassword', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$this->loadModel($id)));
	}
	
	public function actionShowTask($id)
	{
		$this->render('showTask', array('id'=>$id, 'url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$this->loadModel($id)));
	}
	
		/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// display the login form
		if(isset($_POST['Login']))
		{
			$model=new LoginForm;
		
			if(isset($_POST['username']))
			{
				$model->username=$_POST['username'];
			}
			if(isset($_POST['password']))
			{
				$model->password=$_POST['password'];
			}
			if(isset($_POST['rememberMe']))
			{
				//$model->rememberMe=$_POST['rememberMe'];
				if($_POST['rememberMe']==='on')
				{
					$model->rememberMe=true;
				}
				else
				{
					$model->rememberMe=false;
				}
			}
			
			$returUrl=$_GET['url'];
			if(isset($_POST['returnUrl']))
			{
				$returnUrl=$_POST['returnUrl'];
			}
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->redirect(array($_GET['url']));
			}
			else
			{
				$errors=$model->getErrors();
				$error='Invalid Login';
				if(count($errors) > 0)
				{
					foreach($errors as $err_key => $err_val)
					{
						if(isset($err_val) && count($err_val)>0)
						{
							$error=($err_val[0]);
							break;
						}
					}
				}
				
				$acc=Account::model()->findByAttributes(array('username'=>$_POST['username']));
				if(isset($acc))
				{
					$ip_address = Yii::app()->request->getUserHostAddress();
					$count=$acc->getFailedLoginIPCountForLastHour($ip_address);
					if($count > 3)
					{
						$error='Failed login attempts exceed 3 times during the past one hour!';
					}
				}
				
				$this->redirect(array('loginFailed',
					'url'=>$returnUrl,
					'error'=>$error,
				));
			}
		}
		else if(isset($_POST['ForgetPassword']))
		{
			spl_autoload_unregister(array('YiiBase','autoload')); //required when incorporating third party lib
			require_once Yii::app()->basePath.'/extensions/PHPMailer/class.phpmailer.php';
			//require_once Yii::app()->basePath.'/extensions/PHPMailer/languages/phpmailer.lang-en.php';
			require_once Yii::app()->basePath.'/extensions/PHPMailer/class.smtp.php';
			spl_autoload_register(array('YiiBase','autoload')); //required when incorporating third party lib
			
			//in you php.ini make sure you have uncommented the line with
			//extension=php_openssl.dll
			
			$model=Account::model()->find('username=? OR email1=?', array($_POST['username'], $_POST['username']));
			
			if(isset($model) && !$model->isAdmin())
			{
				$password='f@'.uniqid();
				
				$model->password=$password;
				$model->save();
								
				//send a log email to the web master
				$message='Username request a forget password, details below:<br />';
				$message.='<table>';
				$message.='<tr><td><b>Username:</b></td><td>'.$_POST['username'].'</td></tr>';
				$message.='</table>';
				$subject='MnM SMS Organizer Forget Password Request (Valid)';
				$to=Account::ACCTO;
				$from=Account::ACCFROM;
				
				$this->smtpmailer($to, $from, 'Webmaster', $subject, $message);
				
				//send user the email 
				$message='You have requested a forget password, details below:<br />';
				$message.='<table>';
				$message.='<tr><td><b>Username:</b></td><td>'.$_POST['username'].'</td></tr>';
				$message.='<tr><td><b>New Password: </b></td><td>'.$password.'</td></tr>';
				$message.='</table>';
				$subject='MnM SMS Organizer Forget Password Request (Valid)';
				$to=$model->email1;
				$from=Account::ACCFROM;
				
				$this->smtpmailer($to, $from, 'Webmaster', $subject, $message);
			}
			else
			{
				$message='Username request a forget password but supply a wrong username/email, details below:<br />';
				$message.='<table>';
				$message.='<tr><td><b>Username:</b></td><td>'.$_POST['username'].'</td></tr>';
				$message.='<tr><td><b>New Password: </b></td><td>'.$password.'</td></tr>';
				$message.='</table>';
				$subject='MnM SMS Organizer Forget Password Request (Invalid)';
				$to=Account::ACCTO;
				$from=Account::ACCFROM;
				
				$this->smtpmailer($to, $from, 'Webmaster', $subject, $message);
				
			}
			$this->redirect(array($_GET['url']));
		}
		else
		{
			$this->render('login', array('url'=>$_GET['url']));
		}
	}
	
	public function actionChangeTheme($id)
	{
		$this->render('changeTheme', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$this->loadModel($id)));
	}
	
	public function actionSubmitChangeTheme($id)
	{
		if(isset($_POST['theme']))
		{
			$theme=$_POST['theme'];
			$theme_header=$_POST['themeHeader'];
			
			if($theme !== '')
			{
				$model=$this->loadModel($id);
				$model->setTheme($theme);
				$model->setHeaderDataTheme($theme_header);
				if($model->save())
				{
					$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
				}
			}
		}
		$this->redirect(array('site/index'));
	}
}
