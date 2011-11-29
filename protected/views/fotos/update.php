<div id="share_foto">
	<div class="box">
			<?php 

			echo "<div id='mensaje_update_" . $model->id . "' class='mensaje' style='display:none;'>El t&iacute;tulo fue actualizado con &eacute;xito.</div>";
			
			$form=$this->beginWidget('CActiveForm', array(
        		'id'=>'update-form',
        		'enableAjaxValidation'=>true,
        		'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
				)); ?>
			
			
			
				<div class="row">
					T&iacute;tulo<br/>
					<?php echo $form->textField($model,'titulo',array('class'=>'formelement replacer','size'=>20,'maxlength'=>20,'id'=>'titulo_' . $model->id)); ?>
				</div>
			
				<br/>
				<div class="row buttons">
					<?php echo CHtml::ajaxSubmitButton(
						'Enviar',
						CHtml::normalizeUrl(array('fotos/update','id'=>$model->id)),
						array(
							'success'=>'function(){
			                   $("#mensaje_update_' . $model->id . '").show();
			                   $("#image_title").html($("#titulo_' . $model->id . '").val());
			                   
			                }',
							//'success'=>'$("#mensaje_update").show()',
								
						),
						array('class'=>'button','name'=>'update_' . $model->id)); ?>
				</div>
			
			<?php $this->endWidget(); ?>
		</div>
	</div>
