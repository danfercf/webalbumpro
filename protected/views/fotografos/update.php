<?php

$this->layout='public';

/*$this->menu=array(
	array('label'=>'List Fotografos', 'url'=>array('index')),
	array('label'=>'Create Fotografos', 'url'=>array('create')),
	array('label'=>'View Fotografos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fotografos', 'url'=>array('admin')),
);
*/

//echo "<pre>";
//var_dump($model);
//echo "</pre>";
		
?>

<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
            <!--NUEVO-->
            <?php //echo $this->renderPartial('_form_update', array('model'=>$model)); ?>
            <!--FIN NUEVO-->
		</div>
	</div>
	<div class="col2">
		<h1><strong>Mi cuenta</strong></h1>
		<h3>Desde esta pantalla puedes actualizar tus datos.</h3>
		<p class="note">Campos marcados con <span class="required">*</span> son requeridos.</p>
		
	</div>
</div>