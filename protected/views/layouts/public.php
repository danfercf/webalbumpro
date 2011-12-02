<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	<meta name="description" content="El mejor sitio en espa–ol para fotografos profesionales. Gratis." />
	<meta name="keywords" content="fotos, fotografos, profesionales, gratis, servicios, albums, album, eventos, evento" /> 
    
    <?php  
         /* $baseUrl = Yii::app()->baseUrl; 
          $cs = Yii::app()->getClientScript();
          $cs->registerScriptFile($baseUrl.'/js/plupload/js/plupload.full.js');
          $cs->registerCssFile($baseUrl.'/css/yourcss.css');*/
    ?>
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/public-screen.css" />
    <link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-22177551-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

	</script>
</head>

<body>

<div class="bg">
	<div id="header">
		<div class="container">
			<div id="logo" class="">
				<a href="/"><img src="/images/logo.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>" class="pic" /></a>
			</div>
			<div id="toolbar">
			<?php if (Yii::app()->user->isGuest)
			{?>
				<div class="callus">
					<span>Ya te encuentras registrado?</span>
					<span><a href="/site/login/" class="showlogin">Ingresa a tu cuenta</a></span>
				</div>
				<ul class="bigger">
					<li class="highlight"><a href="/fotografos/create/">Reg&iacute;strate, es Gratis</a></li>
					<li class=""><a href="/site/faq/">Preguntas frecuentes</a></li>
					<li class=""><a href="/site/tour/">Tour</a></li>
				</ul>
			<?php }
			else 
			{?>
				<div class="callus">
					<ul>
						<li class=""><a href="/site/logout/">Salir</a></li>
						
						<li class=""><a href="/fotografos/update/id/<?php echo Yii::app()->user->id?>">Mi Perfil</a></li>
						<li class=""><a href="/eventos/">Mis Eventos</a></li>
                        <li class=""><a href="/fotografos/clientes/id/<?php echo Yii::app()->user->id?>">Clientes</a></li>
					</ul>
				</div>
			<?php }?>
			</div>
		</div>
	</div>
	<!-- END HEADER -->
	<!-- ********** -->
	<!--   CONTENT  -->
	<div id="content" class="content">
		<div class="container">
		<?php echo $content; ?>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- *********** -->
	<!--   FOOTER    -->
	<div id="footer" class="content">
		<div class="container">
			<div class="links">
			<br/>
				<a href="/site/about/">Sobre Web Album Pro</a> | <a href="/site/tour/">Tour</a> | <a href="/site/faq/">Preguntas Frecuentes</a> | <a href="/site/tyc/">T&eacute;rminos y Condiciones</a> | <a href="">Blog</a> | <a href="/site/contact/">Contacto</a>
			</div>
			<div class="social">
        		Seguinos en:<br/> <a href="http://www.facebook.com/webalbumpro" target="_blank"><img src="/images/facebook.png" height="30px;" border="0" /></a> <a href="http://www.twitter.com/webalbumpro" target="_blank"><img src="/images/twitter.png" height="30px;" border="0" /></a>
        	</div>
		</div>
	</div>	
</div>
</body>
</html>