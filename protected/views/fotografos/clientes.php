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
	<div class="menu_eventos">
    <div class="escoger">
					<ul>
						<li class=""><a href="#">Bodas</a></li>
						<li class=""><a href="#">Quincea&ntilde;os</a></li>
                        <li class=""><a href="#">Otros</a></li>
					</ul>
	</div>
    </div>
    <div class="col1">
    	<div class="box">
			<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>
            <!--NUEVO-->
            <?php echo $this->renderPartial('_form_cliente', array('model'=>$model)); ?>
            <!--FIN NUEVO-->
		</div>
	</div>
	<!--<div class="col2">
		<div class="box">-->
			<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>
            <!--NUEVO-->
            <?php //echo $this->renderPartial('_form_cliente2', array('model2'=>$model2)); ?>
            <!--FIN NUEVO-->
	<!--	</div>
		
	</div>-->
</div>