<?php $this->layout='public';?>
<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'forgotPass-form',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array('errorCssClass'=>'row error'),
				
			)); 
			
			if ($model->mensaje != '')
			{
				
				echo "<div class='mensaje'>" . $model->mensaje . "</div>";
			}
			echo $form->errorSummary($model); ?>
					<div class="row">
					<?php echo $form->labelEx($model,'email'); ?><br/>
					<?php echo $form->textField($model,'email',array('class'=>'formelement replacer','maxlength'=>100)); ?>
					
				</div>
				<div class="row buttons">
					<?php echo CHtml::submitButton('Enviar',array('class'=>'button')); ?>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div class="col2">
		<h1><strong>Recuperar contrase&ntilde;a</strong></h1>
		<h3>Ingresa el email con el cual te encuentras registrado y te enviaremos una nueva contrase&ntilde;a.</h3>
	</div>
</div>