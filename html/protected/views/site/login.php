<?php
$this->layout='public';

$this->pageTitle=Yii::app()->name . ' - Login';

?>

<div class="tpl-2col">
	<div class="col1">
		<div class="box">
			
			<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array('errorCssClass'=>'row error'),
				
			)); 
			
			echo $form->errorSummary($model); ?>
				<div class="row">
					<?php echo $form->labelEx($model,'username'); ?><br/>
					<?php echo $form->textField($model,'username',array('class'=>'formelement replacer','maxlength'=>100)); ?>
			
				</div>
			
				<div class="row">
					<?php echo $form->labelEx($model,'password'); ?><br/>
					<?php echo $form->passwordField($model,'password',array('class'=>'formelement replacer','maxlength'=>100)); ?>
			
					<br/>
					Si no recuerdas tu contrase&ntilde;a haz <a href="/site/forgotPass/">click aqu&iacute;</a> para recuperarla.
				</div>
				<br/>
				<div class="row">
					<?php echo $form->checkBox($model,'rememberMe'); ?>
					<?php echo $form->label($model,'Recordarme autom&aacute;ticamente la pr&oacute;xima vez'); ?>
			
				</div>
				<br/>
				<div class="row buttons">
					<?php echo CHtml::submitButton('Ingresar',array('class'=>'button big')); ?>
				</div>
			
			<?php $this->endWidget(); ?>
			</div><!-- form -->

		</div>
	</div>
	<div class="col2">
		<h1><strong>Ingreso al sitio</strong></h1>

		<h3>Si ya te encuentras registrado, ingresa tus datos y luego haz click en Ingresar</h3>
		
		<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
		
		<p>Si es la primera vez que ingresas, puedes crear una cuenta haciendo <a href="/fotografos/create/">click aqu&iacute;</a></p>

	</div>
</div>

