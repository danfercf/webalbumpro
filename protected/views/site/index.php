<?php 
$this->layout='public';

$this->pageTitle=Yii::app()->name; ?>

<div id="tpl-home">
	<h1 style="text-align:center;">El <strong>mejor</strong> sitio para fot&oacute;grafos en espa&ntilde;ol... y <strong>gratis!</strong></h1>
	<div class="tpl-2col">
		<div class="col1">

			<h4>Cada vez <strong>m&aacute;s fot&oacute;grafos</strong> est&aacute;n utilizando web album pro porque es la forma m&aacute;s <strong>f&aacute;cil y r&aacute;pida de subir y compartir sus fotos</strong></h4>

			<ul id="features">
			    
				<li>administra fotos de la manera m&aacute;s <strong>f&aacute;cil</strong></li>
				<li><strong>ilimitada</strong> cantidad de fotos</li>
				<li>comparte las fotos con tus <strong>clientes</strong></li>
			</ul>


			<div class="buttons">
				<a href="/fotografos/create" id="homebutton" class="button">Comienza ahora mismo</a>
				<span> o <a href="/site/tour/">Ver el Tour</a></span>
				
			</div>
					
		</div>
	
		<div class="col2">
			<div class="vzaar_media_player">
				<?php 
					$this->widget('ext.Cycle.CycleWidget',
						array(
							'config' => array('fx'=>'fade'),
							'images' => array(
								'/images/home/1.jpg',
								'/images/home/2.jpg',
								'/images/home/3.jpg',
								'/images/home/4.jpg',
							),
							'id' => 'images',
						)
						
					);
				?>
				
			</div>
			<h3 style="background:url(images/quote.png) no-repeat -35px 0;padding:0 0 0 60px;"><em>Por primera vez encuentro un sitio 100% en espa&ntilde;ol que me permite administrar y mostrar fotos de manera profesional&quot;</em> <br><small><img src="/images/home/max.jpg" alt="Maximiliano Pell" width="30" align="absmiddle" style="margin: 5px 5px 0 0;"> Max Pell, Fot&oacute;grafo</small></h3>

		</div>
		<div class="clear"></div>
	</div>
</div>
