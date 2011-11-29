<?php 

$this->layout='public';

?>
<div id="contentHeader">
	<div class="title"><span class="h1">Subir fotos del &aacute;lbum</span></div>
	<div class="name">	
		<span class="h1"><?php echo $model->nombre?></span><br/>
		<?php echo CHtml::link('Ver fotos', array('viewPhotos', 'id'=>$model->id)); ?> | 
		<?php echo CHtml::link('Compartir', array('share', 'id'=>$model->id)); ?> |
		<?php echo CHtml::link('Editar info', array('update', 'id'=>$model->id)); ?>
	</div> 
</div>

<?php



$this->widget('ext.Plupload.PluploadWidget', array(
    'config' => array(
        'runtimes' => 'flash, html5',
        'url' => '/eventos/uploadPhotos/id/' . $model->id,
		'language' => Yii::app()->language,
		'max_file_size' => '10mb',
		'chunk_size' => '1mb',
		'unique_names' => true,
		'filters' => array(array('title' => Yii::t('app', 'Images files'), 'extensions' => 'jpg,jpeg,gif,png')),

    ),
    'id' => 'uploader'
  )); ?>