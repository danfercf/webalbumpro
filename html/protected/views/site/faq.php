<?php 
$this->layout='public';

$this->pageTitle=Yii::app()->name . " - Sobre la empresa"; ?>

<div id="tpl-standard">
	<div class="box">
		<h1>La manera m&aacute;s simple de administrar y compartir tus fotos</h1>
		<h2>Preguntas frecuentes</h2> 
		<?php 
		$this->widget('zii.widgets.jui.CJuiAccordion', array(
		    'panels'=>array(
		        '&iquest;Qu&eacute; es Web Album Pro?'=>'Web Album Pro es la mejor forma de mostrar a tus clientes las fotos de tus eventos. Desde tu oficina o casa puedes subir todas las fotos que quieras de los casamientos, cumples de quince, eventos empresariales, fotos de productos, etc. para mostrarles en forma r&aacute;pida, organizada y segura a tus clientes.',
		        '&iquest;Cuantas fotos puedo subir?'=>'Todas las que quieras! No existen l&iacute;mites de cantidad, tama&ntilde;o o peso.',
				'&iquest;Realmente no hay limite de cantidad de fotos por mes para subir?'=>'Exacto! no hay l&iacute;mite. Se pueden subir todas las fotos que quieras por d&iacute;a, mes, a–o. El œnico limite es de 10MB por foto.',
				'&iquest;Cu&aacute;ntas galer&iacute;as (&aacute;lbums) de fotos puedo crear por mes?'=>'Todas las que queiras.',
				'&iquest;C&oacutemo subo las fotos?'=>'Es muy sencillo. Utilizando nuestra herramienta web puedes subir m&uacute;ltiples fotos al mismo tiempo.',
				'&iquest;Puedo evitar que descarguen las fotos de mis galer&iacute;as?'=>'Actualmente si la persona tiene permisos para visualizar las fotos de un &aacute;lbum puede descargar la foto. En un futuro cercano esta funcionalidad estar&aacute; implementada.',
				'&iquest;Puedo personalizar mi sitio? &iquest;Poner mi logo o marca de agua?'=>'Actualmente no existe dicha funcionalidad, pero en Web Album Pro sabemos lo importante que es tu imagen por lo que ya estamos trabajando para que pr&oacute; puedas disponer de todos estos servicios.',
				'&iquest;Se pueden poner contrase&ntilde;as a las galer&iacute;as de fotos?'=>'Si. Al crear un &aacute;lbum, es opcional el ingreso de una contrase&ntilde;a que ser&aacute; requerida para visualizar las fotos.',
				'&iquest;Realmente no tiene costo?'=>'Asi es. Las funcionalidades que hoy existen en Web Album Pro son gratis y continuar&aacute;n siendo gratis para siempre. En un futuro, nuevas funcionalidades pueden llegar a tener costo, que en caso de que exista, ser&aacute; realmente bajo.'	
		        
		    ),
		    // additional javascript options for the accordion plugin
		    'options'=>array(
		        'animated'=>'bounceslide',
		    ),
		));
		?>
	</div>
</div>
