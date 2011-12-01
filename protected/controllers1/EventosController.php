<?php

class EventosController extends Controller
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
			array('allow',  // deny all users
				'actions'=>array('search','photos'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','uploadPhotos','addPhotos','delete','viewPhotos','share'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
	public function actionShare($id)
	{
		$this->render('share',array('model'=>$this->loadModel($id),));
			
	}
	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		
		if (Yii::app()->user->id == $model->idFotografo)
			$this->render('view',array('model'=>$this->loadModel($id),));
		else
			$this->actionIndex();
	
	}
	
	
	public function actionViewPhotos($id)
	{
		
		
		$model = $this->loadModel($id);
		
		if (Yii::app()->user->id == $model->idFotografo)
		{
			//$thumbs = array();

			// buscamos las fotos que estan en la base
			$criteria = new CDbCriteria();
			//$criteria->addSearchCondition('remoteId','0');
			$criteria->addSearchCondition('idEvento',$id);
			
			$local_photos=new CActiveDataProvider('Fotos',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>20,)));
			
			$this->render('viewPhotos',array('model'=>$model,'dataProvider'=>$local_photos),false,true);	
		}
		else
		{
			$this->actionIndex();
		}
	
	}
	
	public function actionPhotos($id)
	{
		
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('idEvento',$id);
		
		$local_photos=new CActiveDataProvider('Fotos',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>20,)));
		
		
		
		$model = $this->loadModel($id);
		
		
		$this->render('photos',array('model'=>$model,'dataProvider'=>$local_photos));
        
		//$this->render('photos',array('model'=>$this->loadModel($id),'thumbs'=>$thumbs,));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Eventos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Eventos']))
		{
			$model->attributes=$_POST['Eventos'];
			
	
			if($model->save())
			{
				$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
	        	$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
	        	
	        	
	        	
	        	$set_id = $model->idFotografo . "-" . $model->id;
	        	$set_description = $model->nombre;
	        	
	        	$new_set = $phpFlickr->photosets_create($set_id, $set_description, "5489573709");
	        	
	        	$model->idSet = $new_set["id"];
	        	
	        	
	        	
	        	$model->save();
	     
	     		// tomar el ID del fotoset y guardarlo en el evento
	        	
	        	$this->redirect(array('addPhotos','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Eventos']))
		{
			$model->attributes=$_POST['Eventos'];
			if($model->save())
				$model->mensaje = "Los datos fueron actualizados exitosamente";
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	 
	public function actionSearch()
	
	{
		$model=new Eventos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Eventos']))
			$model->attributes=$_GET['Eventos'];

		$this->render('search',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	
	{
		
		$criteria = new CDbCriteria();
		
		$criteria->select = "t.*, (select path from Fotos where Fotos.idEvento = t.id LIMIT 1) mainPhoto";
		//$criteria->join = 'LEFT JOIN (select path,id as mainFoto from Fotos where idEvento = t.id LIMIT 1) as Fotos ON Fotos.id = t.id';
		$criteria->distinct = true;
		$criteria->order = "t.id desc";
		
		$criteria->addSearchCondition('idFotografo',Yii::app()->user->id);
		
		
		$dataProvider=new CActiveDataProvider('Eventos',array('criteria'=>$criteria));
		
		//var_dump($dataProvider->getCriteria());
		//die();
		
		$this->render('index',array('dataProvider'=>$dataProvider));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Eventos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Eventos']))
			$model->attributes=$_GET['Eventos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionAddPhotos($id)
	{
		$this->render('addPhotos',array('model'=>$this->loadModel($id),));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionUploadPhotos($id)
	{
		
		
		// HTTP headers for no cache etc
	    //header('Content-type: text/plain; charset=UTF-8');
	    //header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	    //header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    //header("Cache-Control: no-store, no-cache, must-revalidate");
	    //header("Cache-Control: post-check=0, pre-check=0", false);
	    //header("Pragma: no-cache");
	
	    // Settings
	    $targetDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "gallery/evento" . $id;
	    
	    
	    
	    //echo $targetDir;
	    //die();
	    
	    //echo "pasa";
	    //die();
	    
	   	$cleanupTargetDir = false; // Remove old files
	    $maxFileAge = 60 * 125; // Temp file age in seconds
	
	    // 5 minutes execution time
	    @set_time_limit(5 * 60);
	    // usleep(5000);
	
	    // Get parameters
	    $chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
	    $chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
	    $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
	
	    // Clean the fileName for security reasons
	    $fileName = preg_replace('/[^\w\._\s]+/', '', $fileName);
	    
	   
	
	    // Create target dir
	    if (!file_exists($targetDir))
	            @mkdir($targetDir);
	
	    // Remove old temp files
	    if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
	            while (($file = readdir($dir)) !== false) {
	                    $filePath = $targetDir . DIRECTORY_SEPARATOR . $file;
	
	                    // Remove temp files if they are older than the max age
	                    if (preg_match('/\\.tmp$/', $file) && (filemtime($filePath) < time() - $maxFileAge))
	                            @unlink($filePath);
	            }
	
	            closedir($dir);
	    } else
	            throw new CHttpException (500, Yii::t('app', "Can't open temporary directory."));
	
	    // Look for the content type header
	    if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];
	
	    if (isset($_SERVER["CONTENT_TYPE"]))
	            $contentType = $_SERVER["CONTENT_TYPE"];
	
	    if (strpos($contentType, "multipart") !== false) {
	            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
	                    // Open temp file
	                    $out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
	                    if ($out) {
	                            // Read binary input stream and append it to temp file
	                            $in = fopen($_FILES['file']['tmp_name'], "rb");
	
	                            if ($in) {
	                                    while ($buff = fread($in, 4096))
	                                            fwrite($out, $buff);
	                            } else
	                                    throw new CHttpException (500, Yii::t('app', "Can't open input stream."));
	
	                            fclose($out);
	                            unlink($_FILES['file']['tmp_name']);
	                    } else
	                            throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
	            } else
	                    throw new CHttpException (500, Yii::t('app', "Can't move uploaded file."));
	    } else {
	            // Open temp file
	            $out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
	            if ($out) {
	                    // Read binary input stream and append it to temp file
	                    $in = fopen("php://input", "rb");
	
	                    if ($in) {
	                            while ($buff = fread($in, 4096))
	                                    fwrite($out, $buff);
	                    } else
	                            throw new CHttpException (500, Yii::t('app', "Can't open input stream."));
	
	                    fclose($out);
	            } else
	                    throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
	    }
	
	    // After last chunk is received, process the file
	    $ret = array('result' => '1');
	    if (intval($chunk) + 1 >= intval($chunks)) {
	
	        $originalname = $fileName;
	        if (isset($_SERVER['HTTP_CONTENT_DISPOSITION'])) {
	            $arr = array();
	            preg_match('@^attachment; filename="([^"]+)"@',$_SERVER['HTTP_CONTENT_DISPOSITION'],$arr);
	            if (isset($arr[1]))
	                $originalname = $arr[1];
	        }
	
	        // **********************************************************************************************
	        // Do whatever you need with the uploaded file, which has $originalname as the original file name
	        // and is located at $targetDir . DIRECTORY_SEPARATOR . $fileName
	        // **********************************************************************************************
	        
	        $photo = $targetDir . DIRECTORY_SEPARATOR . $fileName;
	        
	        
	        
	        $model = $this->loadModel($id);
	        
	        // guardo la foto en la DB
	        $fotos = new Fotos();
	        
	        $fotos->path = $photo;
	        $fotos->idEvento = $model->id;
	        
	        $fotos->save();
	        
	        $image = getimagesize($photo);

	        if ($image[0] > $image[1]) 
	        	$width = 600;
	        else
	        	$width = 300;
	        
	        
	        
	        // guardo la imagen en 100 x 100 adapive
	        Yii::app()->request->baseUrl.ImageHelper::thumb(100,100,$photo, array('method' => 'adaptiveResize'),'thumb','adaptiveResize',false);
	        
	        // guardo la imagen en 800 x X adapive
	        Yii::app()->request->baseUrl.ImageHelper::thumb($width,800,$photo, array('method' => 'resize'),'regular','resize',true);
	        
	        
	        
	    }
	
	    
	    //$this->render('uploadPhotos');
	    // Return response
	    die(json_encode($ret));
	
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Eventos::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function getMainPhoto($setId)
	{
		$model=Eventos::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$phpFlickr = $this->flickrLogin();
		
		echo $phpFlickr->photosets_getInfo($photoset_id);
	}
	
	public function flickrLogin()
	{
		$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
	        
	   	$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
	   	
	   	return $phpFlickr;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='eventos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
}
?>