<div id="share_foto">
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
				$subject = 'Te han compartido una foto';
				$message = $fotografo->nombre . " " . $fotografo->apellido . " te ha compartido una foto en Web Album Pro. Para verla haz click en el siguiente link: " . $this->createAbsoluteUrl('fotos/view/',array('id'=>$model->id)) . "\r\n";
				
				$headers="From: info@webalbumpro.com\r\nReply-To: info@webalbumpro.com\r\n";
				$headers=$headers . "Content-type: text/html; charset=utf-8\r\n";  
				mail($toemail, utf8_decode($subject), utf8_decode($message),$headers);
				
				
			}
			
			echo "<div id='mensaje_" . $model->id . "' class='mensaje' style='display:none;'>La foto ha sido compartida</div>";
			
			$form=$this->beginWidget('CActiveForm', array(
        		'id'=>'comment-form',
        		'enableAjaxValidation'=>true,
        		'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
				)); ?>
			
			
			
				<div class="row">
					Nombre: <br/><?php echo CHtml::textField("nombre",NULL,array('class'=>'formelement replacer','size'=>60,'maxlength'=>100));?>
				</div>
			
				<div class="row">
					E-mail: <br/><?php echo CHtml::textField("email", NULL,array('class'=>'formelement replacer','size'=>60,'maxlength'=>100));?>
				</div>
				
				<div class="row">
					Mensaje que se enviar&aacute;: <br/> 
					<?php echo $fotografo->nombre . " " . $fotografo->apellido?> te ha compartido una foto en Web Album Pro. Para verla haz <?php echo CHtml::link('click aqu&iacute;', $this->createAbsoluteUrl('fotos/view/',array	('id'=>$model->id)));?>.
				</div>
				<br/>
				<div class="row buttons">
					<?php echo CHtml::ajaxSubmitButton(
						'Enviar',
						CHtml::normalizeUrl(array('fotos/share','id'=>$model->id)),
						array(
							'success'=>'$("#mensaje_' . $model->id . '").show()',
								
						),
						array('class'=>'button','name'=>'share_' . $model->id)); ?>
				</div>
			
			<?php $this->endWidget(); ?>
		</div>
	</div>
