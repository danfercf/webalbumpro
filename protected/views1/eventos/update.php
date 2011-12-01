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
		<h1>Actualizar informaci&oacute;n del &aacute;lbum</h1>
		<p class="note">Campos marcados con <span class="required">*</span> son requeridos.</p>
		<h2>Desde aqu&iacute; tambi&eacute;n puedes:</h2>
		<ul>
			<li><a href="/eventos/viewPhotos/id/<?php echo $model->id?>">Ver las fotos del &aacute;lbum</a></li>
			<li><a href="/eventos/addPhotos/id/<?php echo $model->id?>">Subir nuevas fotos</a></li>
			<li><a href="/eventos/share/id/<?php echo $model->id?>">Compartir el &aacute;lbum</a></li>
			<li><a href="/eventos/">Volver al listado de &aacute;lbums</a></li>
		</ul>
	</div>
</div>	