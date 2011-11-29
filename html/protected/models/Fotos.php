<?php

/**
 * This is the model class for table "Fotos".
 *
 * The followings are the available columns in table 'Fotos':
 * @property integer $id
 * @property string $nombre
 * @property string $fecha
 * @property integer $idFotografo
 *
 * The followings are the available model relations:
 * @property Fotografos $idFotografo0
 */
class Fotos extends CActiveRecord
{
	
	public $f_photo_large;
	public $f_photo_original;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return fotos the static model class
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
		return 'Fotos';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('nombre', 'required'),
			array('titulo', 'length', 'max'=>200),
			//array('fecha', 'safe'),
			array('id,path,idEvento,remoteId,remoteSetId', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, nombre, fecha', 'safe', 'on'=>'search'),
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
			'idEvento' => array(self::BELONGS_TO, 'Eventos', 'idEvento'),
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
		$criteria->compare('path',$this->nombre,true);
		$criteria->compare('idEvento',$this->fecha,true);
		$criteria->compare('remoteId',$this->idFotografo);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	public function flickrLogin()
	{
		$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
	        
	   	$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
	   	
	   	return $phpFlickr;
	}
	
	protected function afterFind()
	{
		$phpFlickr = $this->flickrLogin();
		
		$photo = $phpFlickr->photos_getInfo($this->remoteId);
		//echo "<pre>";
		//var_dump($photo['photo']);
		//echo "</pre>";
		
		
		$this->f_photo_large = $phpFlickr->buildPhotoURL($photo['photo'],"large");
		$this->f_photo_original = $phpFlickr->buildPhotoURL($photo['photo'],"small");
		
		return TRUE;
	}
	 
}