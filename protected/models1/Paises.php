<?php

/**
 * This is the model class for table "Paises".
 *
 * The followings are the available columns in table 'Paises':
 * @property integer $id
 * @property string $nombre
 * @property string $fecha
 * @property integer $idFotografo
 *
 * The followings are the available model relations:
 * @property Fotografos $idFotografo0
 */
class Paises extends CActiveRecord
{
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
		return 'paises';
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
			//array('nombre', 'length', 'max'=>100),
			//array('fecha', 'safe'),
			array('idPais,PAI_ISONUM,PAI_ISO2,PAI_ISO3,PAI_NOMBRE', 'safe'),
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
			'idPais' => array(self::BELONGS_TO, 'paises', 'idPais'),
            'provincia'=>array(self::HAS_MANY, 'provincia', 'idProvincia'),
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

		$criteria->compare('idPais',$this->id);
		$criteria->compare('path',$this->nombre,true);
		$criteria->compare('idEvento',$this->fecha,true);
		$criteria->compare('remoteId',$this->idFotografo);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
		 
}
?>