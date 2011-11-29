<?php

class FotografosController extends Controller
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
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','view',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index',),
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
		if ($id == Yii::app()->user->id)
			$this->render('view',array('model'=>$this->loadModel($id),));
		else
			$this->render('view',array('model'=>$this->loadModel(Yii::app()->user->id),));
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Fotografos;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Fotografos']))
		{
			$model->attributes=$_POST['Fotografos'];
			
			if($model->save())
			{	
				
				$pass_old = $model->pass;
				$pass = $model->hashPassword($pass_old,Yii::app()->params["salt"]);
				$model->pass_repeat = $model->hashPassword($model->pass_repeat,Yii::app()->params["salt"]);
				$model->pass = $pass;
				
				if($model->save())
				{
					$mensaje = "Hola ";// . $model->nombre . ",\r\n";
					$mensaje = $mensaje . "Tu nueva cuenta en Web Album Pro ha sido creada! \r\n";
					$mensaje = $mensaje . "Para ingresar al sitio sigue el siguiente link: " . $this->createAbsoluteUrl('site/login/') . "\r\n";
					$mensaje = $mensaje . "Por cualquier inquetud, sugerencia o necesidad, puedes contactarnos en el siguiente formulario: " . $this->createAbsoluteUrl('site/contact/') . "\r\n\r\n";
					$mensaje = $mensaje . "Te agradecemos que nos hayas elegido y esperamos que nuestro servicio sea lo que buscabas. \r\n\r\n";
					$mensaje = $mensaje . "El equipo de Web Album Pro";
					
					mail($model->email,'Tu nueva cuenta en Web Album Pro',$mensaje);

					// UserIdentity is your extended class of CUserIdentity
					$identity=new UserIdentity($model->email,$pass_old);
					$identity->authenticate();
					
					$duration= 3600*24*30; // 30 days
					
					Yii::app()->user->login($identity, $duration);
					
					$this->redirect(array('eventos/index'));
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
		$model=$this->loadModel(Yii::app()->user->id);
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Fotografos']))
		{
			$model->attributes=$_POST['Fotografos'];
			
			// guardo los datos actuales "por las dudas"
			$old_model = $this->loadModel($model->id);
			
			if($model->save())
			{
				// pregunto si el password cambio
				if ($model->pass != '')
				{
					// como cambio, hasheo y guardo el nuevo password
					$pass_old = $model->pass;
					$pass = $model->hashPassword($pass_old,Yii::app()->params["salt"]);
					$model->pass_repeat = $model->hashPassword($model->pass_repeat,Yii::app()->params["salt"]);
					$model->pass = $pass;
				}
				else
				{
					$model->pass = $old_model->pass;
					$model->pass_repeat = $old_model->pass;
				}
			
				if($model->save())
				{
					$model->mensaje = "Los datos fueron actualizados exitosamente";
				}
					
			}
		}

		
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
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
		$dataProvider=new CActiveDataProvider('Fotografos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Fotografos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fotografos']))
			$model->attributes=$_GET['Fotografos'];

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
		$model=Fotografos::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='fotografos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
