<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actionTour()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('tour');
	}
	
	public function actionAbout()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('about');
	}
	
	public function actionTyc()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('tyc');
	}
	
	public function actionFaq()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('faq');
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
/**
	 * This is the action to handle external exceptions.
	 */
	public function actionforgotPass()
	{
		$model=new Fotografos();
		
		//
		if(isset($_POST['Fotografos']))
		{	
			$model->attributes=$_POST['Fotografos'];
			$fotografos = Fotografos::model()->findByAttributes(array('email'=>$model->email));
			
			if (is_null($fotografos))
			{
				// no se encontro el email, hay que mostrar un mensaje
				$model->addError('email','El email ingresado no pertenece a ning&uacute;n usuario.');
			}
			else 
			{
				// se encontro el mail. generar un pass nuevo, guardarlo encriptado y enviarlo a la base.
				$length = 10;
				$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
				shuffle($chars);
				$password = implode(array_slice($chars, 0, $length));
				
				$hash_pass = $fotografos->hashPassword($password,Yii::app()->params["salt"]);
				
				$fotografos->pass = $hash_pass;
				$fotografos->pass_repeat = $hash_pass;
				
				$fotografos->save(false,array('pass'));
				//die();
				
					$mensaje = "Tu nueva contrase&ntilde;a ha sido generada: " . $password . "\r\n";
					$mensaje = $mensaje . "Para ingresar sigue el siguiente link: " . $this->createAbsoluteUrl('site/login/');
					$mail = mail($fotografos->email,'Tu nueva contrase–a',$mensaje);
					//echo $mail;
					//echo "pasa";
				
				
				//echo $password;
				
				// mostrar mensaje de email enviado.
				$model->mensaje = "Nueva contrase&ntilde;a enviada existosamente. Si ya la recibiste, puedes ingresar haciendo <a href='/site/login/'>click aqu&iacute;</a>"; 
				
				
				//die();
				
				//var_dump($fotografos);
			}
			//  
			
		}
		$this->render('forgotPass',array('model'=>$model));
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				//echo Yii::app()->params['adminEmail'];
				//die();
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Gracias por contactarnos. Estaremos respondiendo a la brevedad.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
        
        
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            
			if($model->validate() && $model->login() && $model->comparar())
				$this->redirect(array('eventos/index'));
				//$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    public function actionconfirmarMail()
	{
        
		$this->render('confirmarmail');
	}
    
    public function actionConfirmacion(){
        if(isset($_GET['key'])){
            $params['token']=$_GET['key'];
        }
        $model=new Fotografos;
        $fotografos = Fotografos::model()->findByAttributes(array('token'=>$params['token']));
        if (is_null($fotografos))
			{
				//no se encontro el token, hay que mostrar un mensaje
				$model->mensaje = "No existe esa clave de confirmaci&oacute;n.";
                
                
            }
			else 
			{    
                /*$var=84;
                $row = Yii::app()->db->createCommand(array(
                    'select' => array('nombre', 'email'),
                    'from' => 'fotografos',
                    'where' => 'id=:id',
                    'params' => array(':id'=>$var),
                ))->queryRow();
                
                //print_r($row);
                foreach ($row as $dato=>$v){
                echo "$dato: ".$v."</br>";
                }*/
                
			    $model->mensaje = "Confirmaci&oacute;n de correo completada correctamente. </br>
                Ya puede ingresar en su cuenta <a href='/site/login/'>aqu&iacute;</a>";
                $fotografos->registrado = 1;
                $fotografos->save(false,array('registrado'));
                
                /*echo "<pre>";
                print_r($fotografos);
                echo "</pre>";*/
			}
        $this->render('confirmarmail',array('model'=>$model));
        
    }
}
?>