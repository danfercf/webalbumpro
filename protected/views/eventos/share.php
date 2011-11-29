<?php
$this->layout='public';


?>
<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php 
			$fotografo = Fotografos::model()->findByPk(Yii::app()->user->id);
			
			
			if (isset($_REQUEST['email']))
			//if "email" is filled out, send email
			{
				//send email
				$name="Web Album Pro"; 
				$myemail="share@webalbumpro.com";	
				$toemail = $_REQUEST['email'];	
				$subject = 'Te han compartido fotos de un &aacute;lbum';
				$message = $fotografo->nombre . " " . $fotografo->apellido . " te ha compartido la fotos del &aacute;lbum " . $model->nombre . " en Web Album Pro. Para verlas haz click en el siguiente link: " . $this->createAbsoluteUrl('eventos/photos/',array('id'=>$model->id)) . "\r\n";
				
				if ($model->pass != '')
					$message = $message . "La contrase&ntilde;a para visualizar el &aacute;lbum es: " . $model->pass; 	
				
				$headers="From: info@webalbumpro.com\r\nReply-To: info@webalbumpro.com\r\n";
				$headers=$headers . "Content-type: text/html; charset=utf-8\r\n";  
				mail($toemail, utf8_decode($subject), utf8_decode($message),$headers);
				
				echo "<div class='mensaje'>El &aacute;lbum ha sido compartido con " . $_REQUEST['nombre'] . "</div>";
			}
			$form=$this->beginWidget('CActiveForm'); ?>
				<div class="row">
					Nombre: <br/><?php echo CHtml::textField("nombre",NULL,array('class'=>'formelement replacer','size'=>60,'maxlength'=>100));?>
				</div>
			
				<div class="row">
					E-mail: <br/><?php echo CHtml::textField("email", NULL,array('class'=>'formelement replacer','size'=>60,'maxlength'=>100));?>
				</div>
				
				<div class="row">
					Mensaje que se enviar&aacute;: <br/> 
					"<?php echo $fotografo->nombre . " " . $fotografo->apellido?> te ha compartido la fotos del &aacute;lbum <?php echo $model->nombre?> en Web Album Pro. Para verlas haz <?php echo CHtml::link('click aqu&iacute;', $this->createAbsoluteUrl('eventos/photos/',array('id'=>$model->id)));?>.
				</div>
				<br/>
				<div class="row buttons">
					<?php echo CHtml::submitButton('Enviar',array('class'=>'button')); ?>
				</div>
			
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div class="col2">
		<h1>Compartir &aacute;lbum</h1>
		<p>Desde esta pantalla puedes compartir el &aacute;lbum con quien quieras. Recuerda que si el &aacute;lbum est&aacute; protegido con contrase&ntilde;a la misma ser&aacute; enviada en el texto del email.</p>
		<h2>Desde aqu&iacute; tambi&eacute;n puedes:</h2>
		<ul>
			<li><a href="/eventos/update/id/<?php echo $model->id?>">Ver / Actualizar datos el &aacute;lbum</a></li>
			<li><a href="/eventos/viewPhotos/id/<?php echo $model->id?>">Ver las fotos del &aacute;lbum</a></li>
			<li><a href="/eventos/addPhotos/id/<?php echo $model->id?>">Subir nuevas fotos</a></li>
			<li><a href="/eventos/">Volver al listado de &aacute;lbums</a></li>
		</ul>
	</div>
</div>	


