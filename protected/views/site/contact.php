<?php
$this->layout='public';

$this->pageTitle=Yii::app()->name . " - Contacto";
?>


<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?><br/>
		<?php echo $form->textField($model,'name',array('class'=>'formelement replacer','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?><br/>
		<?php echo $form->textField($model,'email',array('class'=>'formelement replacer','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?><br/>
		<?php echo $form->textField($model,'subject',array('class'=>'formelement replacer','size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?><br/>
		<?php echo $form->textArea($model,'body',array('class'=>'formelement replacer','rows'=>6, 'cols'=>50)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?><br/>
		<?php echo $form->textField($model,'verifyCode',array('class'=>'formelement replacer','size'=>60,'maxlength'=>100)); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		
		</div>
		<div class="hint">Ingresa las letras tal cual aparecen en la imagen superior.</div>
		
	</div>
	<?php endif; ?>
	<br/><br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
		</div>
	</div>
	<div class="col2">
		<h1><strong>Ponte en contacto</strong></h1>
		<h3>Utiliza este formulario para enviarnos cualquier tipo de consulta, sugerencia, queja, lo que quieras! Nuestra pol&iacute;tica es contestar cada una de las consultas, pero puede que demoremos asi que tennos paciencia :)</h3>
		<p class="note">Campos marcados con <span class="required">*</span> son requeridos.</p>
	</div>
</div>

