<?php $this->layout='public';

$this->pageTitle=Yii::app()->name . " - Crea una cuenta"; ?>
<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
	<div class="col2">
		<h1><strong>Crea una cuenta</strong></h1>
		<h3>Solo demorar&aacute;s un minuto. Despu&eacute;s, estar&aacute;s listo para comenzar a crear albums, subir fotos y compartirlas con tus clientes.</h3>
		<p class="note">Campos marcados con <span class="required">*</span> son requeridos.</p>
		<p>Si ya posees una cuenta, puedes ingresar haciendo <a href="/site/login/">click aqu&iacute;</a></p>
	</div>
</div>