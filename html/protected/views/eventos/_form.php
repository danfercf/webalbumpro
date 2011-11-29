<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'eventos-form',
	'enableAjaxValidation'=>false,
)); 


if ($model->mensaje != '')
{
	
	echo "<div class='mensaje'>" . $model->mensaje . "</div>";
}

?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?><br/>
		<?php echo $form->textField($model,'nombre',array('class'=>'formelement replacer','size'=>60,'maxlength'=>100)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?><br/>
	
		<?php 
	
	
		
	
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'language' => 'es',
			'attribute' => 'fecha',
			'options' => array(
				'showAnim' => 'fold',
				'dateFormat' => 'dd/mm/yy',
				),
			'htmlOptions' => array(
				'class' => 'formelement replacer',
				)
			));
			
			
	/*
			
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'language' => 'es',
                    'attribute' => 'fecha',
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                    ),
            ));
	
	*/
	
	?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?><br/>
		<?php echo $form->textField($model,'pass',array('class'=>'formelement replacer','size'=>20,'maxlength'=>20)); ?> 
		<br/>Dejar en blanco si no requiere seguridad
		
	</div>
	
<br/>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'button big')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->