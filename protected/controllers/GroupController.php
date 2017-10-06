<?php

class GroupController extends Controller
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
				'addGroup',
				'deleteGroup', 'submitDeleteGroup', 'updateGroup'),
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
	
	public function actionAddGroup()
	{
		if(isset($_POST['AddGroup']))
		{
			$group = new Group;
			if(isset($_POST['groupname']))
			{
				$group->groupname=trim($_POST['groupname']);
			}
			if(isset($_POST['org_name']))
			{
				$group->org_name=trim($_POST['org_name']);
			}
			if(isset($_POST['description']))
			{
				$group->description=trim($_POST['description']);
			}
			
			if(!isset($group->groupname) || $group->groupname==='')
			{
				$groupname_error=Yii::t('translation', 'Name cannot be empty');
				$this->render('addGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$group, 'groupname_error'=>$groupname_error));
			}
			else 
			{
				$user=Yii::app()->accountMgr->getAccount();
				$existing_model=Group::model()->find('groupname=? AND account_id=?', array($group->groupname, $user->id));
				
				if(isset($existing_model))
				{
					$groupname_error=Yii::t('translation', 'Name').' '.Yii::t('translation', 'already exists');
					$this->render('addGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'model'=>$group, 'groupname_error'=>$groupname_error));
				}
				else
				{
					if($group->save())
					{
						$filename=$group->getImagePath();
						$this->saveUpload('groupImg', $group, $filename);
						$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id'], 'sub_field_id'=>$group->id));
					}
					else
					{
						$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to add the group'));
					}
				}
			}
		}
		elseif(isset($_POST['Cancel']))
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->render('addGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		
	}
	
	public function actionUpdateGroup($id)
	{
		if(isset($_POST['UpdateGroup']))
		{
			$group = $this->loadModel($id);
			if(isset($_POST['groupname']))
			{
				$group->groupname=trim($_POST['groupname']);
			}
			if(isset($_POST['org_name']))
			{
				$group->org_name=trim($_POST['org_name']);
			}
			if(isset($_POST['description']))
			{
				$group->description=trim($_POST['description']);
			}
			
			if(!isset($group->groupname) || $group->groupname==='')
			{
				$groupname_error=Yii::t('translation', 'Name cannot be empty');
				$this->render('updateGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'group'=>$group, 'groupname_error'=>$groupname_error));
			}
			else
			{
				$user=Yii::app()->accountMgr->getAccount();
				$existing_model=Group::model()->find('groupname=? AND account_id=?', array($group->groupname, $user->id));
				
				if(isset($existing_model) && $existing_model->id != $group->id)
				{
						$groupname_error=Yii::t('translation', 'Name').' '.Yii::t('translation', 'already exists');
						$this->render('updateGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'group'=>$group, 'groupname_error'=>$groupname_error));
				}
				else
				{
					if($group->save())
					{
						$filename=$group->getImagePath();
						$this->saveUpload('groupImg', $group, $filename);
						$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id'], 'sub_field_id'=>$group->id));
					}
					else
					{
						$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to update the group'));
					}
				}
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
			$this->render('updateGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'group'=>$model));
		}
	}
	
	public function actionDeleteGroup($id)
	{
		$group=$this->loadModel($id);
		$this->render('deleteGroup', array('url'=>$_GET['url'], 'field_id'=>$_GET['field_id'], 'group'=>$group));
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
	
	public function actionSubmitDeleteGroup($id)
	{
		$group=$this->loadModel($id);
		
		if($group->delete())
		{
			$this->redirect(array($_GET['url'], 'field_id'=>$_GET['field_id']));
		}
		else
		{
			$this->redirect(array($_GET['url'], 'field_id'=>SiteStateMachine::FIELD_ERROR, 'error'=>'failed to delete the group'));
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
		$model=new Group;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
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

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
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
		$dataProvider=new CActiveDataProvider('Group');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Group('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Group'];

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
		$model=Group::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
