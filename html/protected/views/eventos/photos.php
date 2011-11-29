<?php
$this->layout='public';

// primero checkeo si el evento esta protegido
if ($model->pass != '')
{
	// luego pregunto si la persona ya introdujo la clave, por lo que puede pasar
	if (isset(Yii::app()->request->cookies[$model->id]->value))
	{
		showPhotos($this,$dataProvider,$model);
	}	
	else 
	{
		// como no tiene la variable en sesion preguntamos si ya completo el form de login
		if (isset($_POST['Eventos']['pass']))
		{
			// preguntas si el pass ingresado es el mismo del guardado
			if ($_POST['Eventos']['pass'] == $model->pass)
			{
				
				$cookie = new CHttpCookie($model->id, $model->pass);
				$cookie->expire = time()+60*60*24*180;
				
				Yii::app()->request->cookies[$model->id] = $cookie; 
				
				showPhotos($this,$dataProvider,$model);
			}
			else
			{
				?>
				<div class="tpl-2col">
					<div class="col1">
						<div class="box">
							<?php 
								echo "<div class='errorSummary'>La contrase&ntilde;a es incorrecta</div>";
								
								$form=$this->beginWidget('CActiveForm', array(
									'id'=>'pass-form',
									'enableAjaxValidation'=>false,
								)); 
								
								
								?>
								<div class="row">
								<?php echo $form->labelEx($model,'pass'); ?><br/>
								<?php echo $form->textField($model,'pass',array('class'=>'formelement replacer','value'=>'', 'size'=>60, 'maxlength'=>100)); ?>
								<?php echo $form->error($model,'pass'); ?>
								</div>
								<?php 
								
								echo CHtml::submitButton('Ver &aacute;lbum',array('class'=>'button'));
								
								$this->endWidget();
							?>
						</div>
					</div>
					<div class="col2">
						<h1><strong>&Aacute;lbum protegido con contras&ntilde;a</strong></h1>
						<h3>Para poder visualizar las fotos del &aacute;lbum debes ingresar la contrase&ntilde;a.</h3>
					</div>
				</div>
				<?php 
				
			}
		}
		else
		{
			?>
			<div class="tpl-2col">
				<div class="col1">
					<div class="box">
						<?php 
							$form=$this->beginWidget('CActiveForm', array(
								'id'=>'pass-form',
								'enableAjaxValidation'=>false,
							)); 
							
							
							?>
							<div class="row">
							<?php echo $form->labelEx($model,'pass'); ?><br/>
							<?php echo $form->textField($model,'pass',array('class'=>'formelement replacer','value'=>'', 'size'=>60, 'maxlength'=>100)); ?>
							<?php echo $form->error($model,'pass'); ?>
							</div>
							<?php 
							
							echo CHtml::submitButton('Ver &aacute;lbum',array('class'=>'button'));
							
							$this->endWidget();
						?>
					</div>
				</div>
				<div class="col2">
					<h1><strong>&Aacute;lbum protegido con contras&ntilde;a</strong></h1>
					<h3>Para poder visualizar las fotos del &aacute;lbum debes ingresar la contrase&ntilde;a</h3>
				</div>
			</div>
			<?php 
		}
		
		
	}
	
	
}
else 
{
	showPhotos($this,$dataProvider,$model);
}



function showPhotos($page,$dataProvider,$model)
{
	

	echo "<style>";
	echo "div#content .container";
	echo "{width:100%;float:left;}";
	echo "div#content .content{padding:20px;}";
	echo "</style>";
	
	echo "<div id='eventMenu'>";
	echo "<h1>" . $model->nombre . "</h1>";
	echo "</div>";

	echo "<h1>Fotos del &aacute;lbum</h1>";

	echo "<div id='fotos'>";
	echo "<div class='col_left'>";
		

		$page->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_viewPhotos',
			'emptyText'=>'No existen fotos para el &aacute;lbum. Para subir nuevas fotos <a href="addPhotos">haz click aqui</a>.',
			'pager'=>array(
				'class'=>'CLinkPager',
				'header'=>'',
				'firstPageLabel'=>'&lt;&lt;',
				'prevPageLabel'=>'&lt;',
				'nextPageLabel'=>'&gt;',	
				'lastPageLabel'=>'&gt;&gt;',
				),
			'cssFile'=>false,
		));
		
	

	echo "</div>";
	echo "<div class='col_right'>";
	echo "<div id='photo'>";
			echo "<img src='' id='main_photo'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	
	
}

?>
