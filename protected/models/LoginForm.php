<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
    public $registrado;
    public $is_registrado=1;
    public $new_pass;
    public $passbd;
    
    
    private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
            array('registrado', 'comparar')
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'username'=>'Email',
			'password'=>'Contrase&ntilde;a',
            'registrado'=>'Registrado'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		
		if(!$this->hasErrors())
		{
			
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Combinaci&oacute;n de Email y Contrase&ntilde;a incorrecta.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
    public function comparar(){
        $this->new_pass=hash('md5',$this->password);
        $row = Yii::app()->db->createCommand(array(
                    'select' => array('nombre','email'),
                    'from' => 'fotografos',
                    'where' => 'email=:user AND pass=:pass AND registrado=:req',
                    'params' => array(':user'=>$this->username,':pass'=>$this->new_pass,':req'=>$this->is_registrado),
                ))->queryRow();
       
        if($row!=''){
            //$this->addError('registrado','Usted todav&iacute;a no confirm&oacute; su registro.');
            return true;
        }else{
            if($this->login()==true){
                $this->addError('registrado','Usted todav&iacute;a no confirm&oacute; su registro.');
            }if($this->login()==false){
                $this->addError('registrado','O usted todav&iacute;a no confirm&oacute; su registro.');
            }
            return false;
        }
        
    }
    public function firstlogin(){
        $this->new_pass=hash('md5',$this->password);
        //echo "aaaaaaaaaaaaa".$this->new_pass;
        $row = Yii::app()->db->createCommand(array(
                    'select' => array('idPais','idProvincia'),
                    'from' => 'fotografos',
                    'where' => 'email=:user AND pass=:pass AND registrado=:req',
                    'params' => array(':user'=>$this->username,':pass'=>$this->new_pass,':req'=>$this->is_registrado),
                ))->queryRow();
        if($row['idPais']!='' && $row['idPais']!=0 ){
            //Si el usuario ya llenó su perfil
            return true;
        }else{
            return false;
        }
    }
}
