<?php

class ContactController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 
					'addContact', 
					'addContactToGroup', 'removeContactFromGroup', 'deleteContact','submitDeleteContact', 'updateContact'),
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
	
	public function actionAddContactToGroup()
	{
		$contact=Contact::model()->findByPk($_GET['contact_id']);
		$this->render('addContactToGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'contact'=>$contact));
	}
	
	public function actionRemoveContactFromGroup()
	{
		$contact=Contact::model()->findByPk($_GET['contact_id']);
		$this->render('removeContactFromGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'contact'=>$contact));
	}
	
	public function actionAddContact()
	{
		if(isset($_POST['AddContact']))
		{
			$model = new Contact;
			if(isset($_POST['first_name']))
			{
				$model->setFirstName(trim($_POST['first_name']));
			}
			if(isset($_POST['last_name']))
			{
				$model->setLastName(trim($_POST['last_name']));
			}
			if(isset($_POST['contact_number']))
			{
				$model->setContactNumber(trim($_POST['contact_number']));
			}
			if(isset($_POST['email']))
			{
				$model->setEmail(trim($_POST['email']));
			}
			if(isset($_POST['org']))
			{
				$model->setOrg(trim($_POST['org']));
			}
			if(isset($_POST['ethnic_group']))
			{
				$model->setEthnicGroup(trim($_POST['ethnic_group']));
			}
			if(isset($_POST['gender_id']))
			{
				$model->gender_id=$_POST['gender_id'];
			}
			
			if($model->getFirstName() !== '' && $model->getContactNumber() !== '')
			{
				$user=Yii::app()->accountMgr->getAccount();
				$existing_model=Contact::model()->find('first_name=? AND phone1=? AND account_id=?', array($model->getFirstName(), $model->getContactNumber(), $user->id)); 
				if(isset($existing_model))
				{
					$error_first_name=Yii::t('translation', 'Contact having the same first name and contact number already exists');
					$error_contact_number=Yii::t('translation', 'Contact having the same first name and contact number already exists');
					$this->render('updateContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model, 'error_first_name'=>$error_first_name, 'error_contact_number'=>$error_contact_number));
				}
				else
				{
					if($model->save())
					{
						$filename=$model->getImagePath();
						$this->saveUpload('contactImg', $model, $filename);
						$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id'], 'sub_field_id'=>$model->id));
					}
					else
					{
						$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to add the contact'));
					}
				}
			}
			else
			{
				$error_first_name='';
				$error_contact_number='';
				if($model->getFirstName() === '')
				{
					$error_first_name=Yii::t('translation', 'Name cannot be empty');
				}
				if($model->getContactNumber() === '')
				{
					$error_contact_number=Yii::t('translation', 'Contact Number cannot be empty');
				}
				$this->render('addContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model, 'error_first_name'=>$error_first_name, 'error_contact_number'=>$error_contact_number));
			}
		}
		else if(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$model=new Contact;
			$this->render('addContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model));
		}
	}
	
	public function actionUpdateContact($id)
	{
		if(isset($_POST['UpdateContact']))
		{
			$model = $this->loadModel($id);
			if(isset($_POST['first_name']))
			{
				$model->setFirstName(trim($_POST['first_name']));
			}
			if(isset($_POST['last_name']))
			{
				$model->setLastName(trim($_POST['last_name']));
			}
			if(isset($_POST['contact_number']))
			{
				$model->setContactNumber(trim($_POST['contact_number']));
			}
			if(issete($_POST['dob']))
			{
				$model->setDOB(trim($_POST['dob']));
			}
			if(isset($_POST['email']))
			{
				$model->setEmail(trim($_POST['email']));
			}
			if(isset($_POST['org']))
			{
				$model->setOrg(trim($_POST['org']));
			}
			
			if($model->getFirstName() !== '' && $model->getContactNumber() !== '')
			{
				$user=Yii::app()->accountMgr->getAccount();
				$existing_model=Contact::model()->find('first_name=? AND phone1=? AND account_id=?', array($model->getFirstName(), $model->getContactNumber(), $user->id)); 
				if(isset($existing_model) && $existing_model->id != $model->id)
				{
					$error_first_name=Yii::t('translation', 'Contact having the same first name and contact number already exists');
					$error_contact_number=Yii::t('translation', 'Contact having the same first name and contact number already exists');
					$this->render('updateContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model, 'error_first_name'=>$error_first_name, 'error_contact_number'=>$error_contact_number));
				}
				else
				{
					if($model->save())
					{
						$filename=$model->getImagePath();
						$this->saveUpload('contactImg', $model, $filename);
						$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id'], 'sub_field_id'=>$model->id));
					}
					else
					{
						$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to update the contact'));
					}
				}
			}
			else
			{
				$error_first_name='';
				$error_contact_number='';
				if($model->getFirstName() === '')
				{
					$error_first_name=Yii::t('translation', 'Name cannot be empty');
				}
				if($model->getContactNumber() === '')
				{
					$error_contact_number=Yii::t('translation', 'Contact Number cannot be empty');
				}
				$this->render('updateContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model, 'error_first_name'=>$error_first_name, 'error_contact_number'=>$error_contact_number));
			}
		}
		elseif(isset($_POST['Delete']))
		{
			$model=$this->loadModel($id);
			$model->delete();
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		elseif(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$model=$this->loadModel($id);
			$this->render('updateContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$model));
		}
	}
	
	public function actionDeleteContact($id)
	{
		$contact=$this->loadModel($id);
		$this->render('deleteContact', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'contact'=>$contact));
	}
	
	private function saveUpload($file_field_id, $model, $filename)
	{	
		if(!isset($_FILES[$file_field_id]) || !isset($_FILES[$file_field_id]["name"]))
		{
			return 'file field not exists';
		}
		
		$allowedExts = array("png");
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
	
	public function actionSubmitDeleteContact($id)
	{
		$contact=$this->loadModel($id);
		
		if($contact->delete())
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to delete the contact'));
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
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
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

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
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
		$dataProvider=new CActiveDataProvider('Contact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contact']))
			$model->attributes=$_GET['Contact'];

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
		$model=Contact::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
