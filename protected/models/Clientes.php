<?php

/**
 * This is the model class for table "Clientes".
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
class Clientes extends CActiveRecord
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
		return 'clientes';
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
			array('nombre_evento,fecha, nombres, apellidos, email, celular, telefono,domicilio,idProvincia,idPais,idFotografos', 'required'), 
			array('email','unique','message'=>'El e-mail ingresado ya existe.'),
			array('nombre_evento, nombres, apellidos, domicilio, facebook', 'length', 'max'=>50),
            array('telefono, celular', 'length', 'max'=>10),
			array('email, facebook', 'length', 'max'=>100),
            array('notas', 'length', 'max'=>200),
			array('fecha,fecha_civil,fecha_cumpleanos,fecha_fotos', 'safe'),
            //array('registrado', 'required'),
            //array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'register')
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nombre_evento, fecha, fecha_civil, nombres, apellidos, email, celular, telefono,domicilio,idProvincia,idPais,facebook,key_novios,key_boda,key_role,key_padres,fecha_cumpleanos,fecha_fotos,idLugar,notas,idFotografos,idEvento', 'safe', 'on'=>'search'),
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
			'clientes_fotografo' => array(self::BELONGS_TO, 'clientes', 'fotografos'),
            'clientes_eventos' => array(self::BELONGS_TO, 'clientes', 'eventos'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'idCliente'=>'idCliente',
            'nombre_evento'=> 'Nombre Evento', 
            'fecha'=>'Fecha', 
            'fecha_civil'=>'Fecha Civil', 
            'nombres'=>'Nombres',
            'apellidos'=>'Apellidos',
            'email'=>'Email', 
            'celular'=>'Celular', 
            'telefono'=>'Tel&eacute;fono',
            'domicilio'=>'Domicilio',
            'idProvincia'=>'Provincia',
            'idPais'=>'Pa&iacute;s',
            'facebook'=>'Facebook',
            'key_novios'=>'key_novios',
            'key_boda'=>'key_boda',
            'key_role'=>'key_role',
            'key_padres'=>'key_padres',
            'fecha_cumpleanos'=>'Fecha cumplea&ntilde;os',//Quinceañeros
            'fecha_fotos'=>'Fecha sesi&oacute;n de fotos',//Quinceañeros
            'idLugar'=>'Lugar',
            'notas'=>'Notas adicionales',
            'idFotografos'=>'Fotogr&aacute;fo',  //Clave foranea fotografos
            'idEvento'=>'Evento'                //Clave foranea evento
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
        $criteria->compare('idCliente',$this->idCliente,true);
        $criteria->compare('nombre_evento',$this->nombre_evento,true);
        $criteria->compare('fecha',$this->fecha,true);
        $criteria->compare('fecha_civil',$this->fecha_civil,true);
        $criteria->compare('nombres',$this->nombres,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('celular',$this->celular,true);
        $criteria->compare('telefono',$this->telefono,true);
        $criteria->compare('domicilio',$this->domicilio,true);
        $criteria->compare('idProvincia',$this->idProvincia,true);
        $criteria->compare('idPais',$this->idPais,true);
        $criteria->compare('facebook',$this->facebook,true);
        $criteria->compare('key_novios',$this->key_novios,true);
        $criteria->compare('key_boda',$this->key_boda,true);
        $criteria->compare('key_role',$this->key_role,true);
        $criteria->compare('key_padres',$this->key_padres,true);
        $criteria->compare('fecha_cumpleanos',$this->fecha_cumpleanos,true);
        $criteria->compare('fecha_fotos',$this->fecha_fotos,true);
        $criteria->compare('idLugar',$this->idLugar,true);
        $criteria->compare('notas',$this->notas,true);
        $criteria->compare('idFotografos',$this->idFotografos,true);//Foraneos
        $criteria->compare('idEvento',$this->idEvento,true);
        
        
      	return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
    protected function afterFind()
	{
		
		return TRUE;
	}
	
}
?>