<?php

/**
 * This is the model class for table "Eventos".
 *
 * The followings are the available columns in table 'Eventos':
 * @property integer $id
 * @property string $nombre
 * @property string $fecha
 * @property integer $idFotografo
 *
 * The followings are the available model relations:
 * @property Fotografos $idFotografo0
 */
class Eventos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Eventos the static model class
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
		return 'Eventos';
	}
	
	public $mainPhoto;
	public $mensaje;
	
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>100),
			array('fecha', 'safe'),
			array('pass', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, fecha', 'safe', 'on'=>'search'),
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
			'idFotografo' => array(self::BELONGS_TO, 'Fotografos', 'idFotografo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre del &aacute;lbum',
			'fecha' => 'Fecha',
			'pass' => 'Contrase&ntilde;a'
			
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('idFotografo',$this->idFotografo);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
	  	if (strpos($this->fecha, "/"))
		{
    		$this->fecha = date('Y-m-d', CDateTimeParser::parse($this->fecha, Yii::app()->locale->dateFormat));
		}
		
					
        if($this->isNewRecord)
        {
            $this->idFotografo=Yii::app()->user->id;
        }
       return true;
	   
	}
	
	
	
	protected function afterFind()
	{
		$this->fecha = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->fecha, 'yyyy-MM-dd'),'medium',null);

		/*
		$phpFlickr = $this->flickrLogin();
		
		$set = $phpFlickr->photosets_getInfo($this->idSet);
		$photo = $phpFlickr->photos_getInfo($set['primary']);
		
		//$this->mainPhoto = $phpFlickr->photos_getInfo($set['primary']);
		$this->mainPhoto = $phpFlickr->buildPhotoURL($photo['photo'], 'square'); 
		*/
		if ($this->mainPhoto != '')
		{
			$photo_name = substr(strrchr($this->mainPhoto, "/"), 1);
				
			$this->mainPhoto = '/gallery/evento' . $this->id . '/thumb/' . $photo_name;
		}
		else 
		{
			$this->mainPhoto = '/images/no_photo.jpg';
		}
		return TRUE;
	}
	
	
	
	public function flickrLogin()
	{
		$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
	        
	   	$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
	   	
	   	return $phpFlickr;
	}
	 
}