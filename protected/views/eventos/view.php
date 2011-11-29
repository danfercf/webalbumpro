<?php
$this->layout='public';

$this->menu=array(
	array('label'=>'Ver fotos', 'url'=>array('viewPhotos','id'=>$model->id)),
	array('label'=>'Agregar fotos', 'url'=>array('addPhotos','id'=>$model->id)),
	array('label'=>'Compartir', 'url'=>array('share','id'=>$model->id)),
	array('label'=>'Ediar datos del Evento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Evento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'S	eguro que desea eleiminar este evento?')),
	
);
?>

<h1>Detalles del evento <?php echo $model->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'fecha',
		'pass',
	),
)); ?>
