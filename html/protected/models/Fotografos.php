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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, nombre, apellido,idPais', 'required'),
			array('pass, pass_repeat','required', 'on'=>'create'),
			array('aceptar_tyc','required','requiredValue'=>1,'message'=>'Debes haceptar los T&eacute;rminos y Condiciones.','on'=>'insert'),
			array('email','unique','message'=>'El e-mail ingresado ya existe.'),
			array('nombre, apellido', 'length', 'max'=>50),
			array('email, pass, pass_repeat', 'length', 'max'=>100),
			array('fechaCreacion', 'safe'),
			array('pass', 'compare','compareAttribute'=>'pass_repeat'),
			//array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'register')
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, apellido, email, pass, fechaCreacion', 'safe', 'on'=>'search'),
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
			'aceptar_tyc'=> 'Acpetar <a href="/site/tyc/" target="_blank">t&eacute;rminos y condiciones</a>',
			'idPais'=>'Pa&iacute;s'
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
    
    protected function afterFind()
	{
		//$this->pass = '';
		//$this->pass_repeat = ''; 
		
		return TRUE;
	}
	
}