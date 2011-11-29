<?php
$this->layout='public';
?>

<div id="tpl-standard">
	<div class="box">
		<h1>Ooops, parece que ocurri&oacute; un error.</h1>
		<img src="/images/iso.png" align="right" />
		<h2>Si refrescando la p&aacute;gina no se soluciona te pedimos que te pongas en contacto con nosotros a trav&eacute;s del siguiente <a href="/site/contact/">formulario</a>. Te pedimos que incluyas el mensaje detallando todo lo posible para ayudarnos a buscar una soluci&oacute;n.</h2>
	 
		<h2>Error <?php echo $code; ?></h2>
		<?php echo CHtml::encode($message); ?>
	
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
</div>

