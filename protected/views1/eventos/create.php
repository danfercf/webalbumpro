<?php
$this->layout='public';
?>

<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
	<div class="col2">
		<h1><strong>Crea un nuevo &aacute;lbum</strong></h1>
		<h3>Solo demorar&aacute;s un minuto. Un vez creado pod&aacute;s comenzar a subir fotos y compartirlas con tus clientes.</h3>
		<p class="note">Campos marcados con <span class="required">*</span> son requeridos.</p>
	</div>
</div>
