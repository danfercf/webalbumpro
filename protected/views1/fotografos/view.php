<?php


$this->menu=array(
	array('label'=>'Actualizar informacion', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>Mis datos</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'apellido',
		'email',
		
	),
)); ?>
