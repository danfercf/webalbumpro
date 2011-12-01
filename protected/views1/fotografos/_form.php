<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'fotografos-form',
	'enableAjaxValidation'=>true,)); ?>


<?php 

if ($model->mensaje != '')
{
	
	echo "<div class='mensaje'>" . $model->mensaje . "</div>";
}
				
/*				
if ($model->hasErrors())
{
	$row_class = "row error";
	  
}
else
{
	$row_class = "row";
}
*/
?>

<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?><br/>
		<?php echo $form->textField($model,'nombre',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?><br/>
		<?php echo $form->textField($model,'apellido',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>
    <!--SELECT PAISES-->
	<!--<div class="row">
		<?php //echo $form->labelEx($model,'idPais'); ?><br/>
        <?php //echo $form->dropDownList($model,'idPais',CHtml::listData(Paises::model()->findAll(),'idPais','PAI_NOMBRE'),array('class'=>'formelement replacer','maxlength'=>50)); ?>
        
    </div>-->
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?><br/>
		<?php echo $form->textField($model,'email',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?><br/>
		<?php echo $form->passwordField($model,'pass',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pass_repeat'); ?><br/>
		<?php echo $form->passwordField($model,'pass_repeat',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
	<?php if (!isset($model->id)) { ?>
	<div class="row">
		<?php echo $form->checkBox($model,'aceptar_tyc'); ?>&nbsp;<?php echo $form->labelEx($model,'aceptar_tyc'); ?>
		
	</div>
	<?php }?>
	<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear cuenta' : 'Guardar',array('class'=>'button big')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->