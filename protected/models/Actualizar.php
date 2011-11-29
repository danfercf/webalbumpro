<?php

/**
 * This is the model class for table "Fotografos".
 *
 * The followings are the available columns in table 'Fotografos':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $pass
 * @property string $fechaCreacion
 *
 * The followings are the available model relations:
 * @property Eventos[] $eventoses
 */
class Fotografos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Fotografos the static model class
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
		return 'Fotografos';
	}
	
	
	public $pass_repeat;
	public $mensaje;
	public $aceptar_tyc;
    //public $registrado;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, nombre, apellido, idPais, provincia, localidad, direccion, telefono', 'required'), //falta pais
			array('pass, pass_repeat','required', 'on'=>'create'),
			array('email','unique','message'=>'El e-mail ingresado ya existe.'),
			array('nombre, apellido, direccion', 'length', 'max'=>50),
            array('telefono, telefono2', 'length', 'max'=>10),
			array('email, pass, pass_repeat, token, url_web, url_blog, facebook, twitter, foto', 'length', 'max'=>100),
            array('info', 'length', 'max'=>200),
			array('fechaCreacion', 'safe'),
            //array('registrado', 'required'),
            array('pass', 'compare','compareAttribute'=>'pass_repeat'),
            //array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'register')
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, apellido, email, pass, fechaCreacion, idPais, token, registrado, provincia, localidad, direccion, telefono, telefono2, url_web, url_blog, facebook, twitter, foto, info', 'safe', 'on'=>'search'),
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
			'eventoses' => array(self::HAS_MANY, 'Eventos', 'idFotografo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'email' => 'Email',
			'pass' => 'Contrase&ntilde;a',
			'pass_repeat' => 'Confirmaci&oacute;n de contrase&ntilde;a',
			'fechaCreacion' => 'Fecha Creacion',
			'idPais'=>'Pa&iacute;s',
            'provincia'=>'Provincia', 
            'localidad'=>'Localidad', 
            'direccion'=>'Direcci&oacuten;',
            'telefono'=>'Tel&eacutefono;',
            'telefono2'=>'Tel&eacutefono; Secundario',
            'url_web'=>'Url Web',
            'url_blog'=>'Url Blog',
            'facebook'=>'Facebook',
            'twitter'=>'Twitter',
            'foto'=>'Foto de Perfil',
            'info'=>'Informaci&iacuteon Adicional'
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('fechaCreacion',$this->fechaCreacion,true);
        $criteria->compare('token',$this->token,true);
        $criteria->compare('registrado',$this->registrado,true);
        $criteria->compare('idPais',$this->idPais,true);
        $criteria->compare('provincia',$this->provincia,true);
        $criteria->compare('localidad',$this->localidad,true);
        $criteria->compare('telefono',$this->telefono,true);
        $criteria->compare('telefono2',$this->telefono2,true);
        $criteria->compare('url_web',$this->url_web,true);
        $criteria->compare('url_blog',$this->url_blog,true);
        $criteria->compare('facebook',$this->facebook,true);
        $criteria->compare('twitter',$this->twitter,true);
        $criteria->compare('info',$this->info,true);
        $criteria->compare('telefono2',$this->telefono2,true);
        

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
    {
    	//echo $this->pass . "<br/>";
    	//echo $this->hashPassword($password,Yii::app()->params["salt"]); 
    	
    	
    	
    	return $this->hashPassword($password,Yii::app()->params["salt"])===$this->pass;
    }
 
    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }
    
    /*Funcion md5 email-clave de confirmacion*/
    public function getToken($email){
        return md5($email);
    }
    
    protected function afterFind()
	{
		//$this->pass = '';
		//$this->pass_repeat = ''; 
		
		return TRUE;
	}
	
}
?>