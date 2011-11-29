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
	<div class="row">
		<?php echo $form->labelEx($model,'idPais'); ?><br/>
        <?php echo $form->dropDownList($model,'idPais',CHtml::listData(Paises::model()->findAll(),'idPais','PAI_NOMBRE'),array('class'=>'formelement replacer','maxlength'=>50)); ?>
        
    </div>
    <!--SELECT provincias-->
    <div class="row">
		<?php echo $form->labelEx($model,'provincias'); ?><br/>
        <?php echo $form->dropDownList($model,'provincias',CHtml::listData(Provincias::model()->findAll(),'idprovincia','prov_nombre'),array('class'=>'formelement replacer','maxlength'=>50)); ?>
        
    </div>
    <!--SELECT localidad-->
    <div class="row">
		<?php echo $form->labelEx($model,'localidad'); ?><br/>
        <?php echo $form->dropDownList($model,'localidad',CHtml::listData(Localidad::model()->findAll(),'idlocalidad','loc_nombre'),array('class'=>'formelement replacer','maxlength'=>50)); ?>
        
    </div>
    <!--TEXT direccion-->
    <div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?><br/>
        <?php echo $form->textField($model,'direccion',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    <!--TEXT telefono-->
    <div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?><br/>
        <?php echo $form->textField($model,'telefono',array('class'=>'formelement longer','size'=>10,'maxlength'=>10)); ?>
        
    </div>
    <!--TEXT telefono2-->
    <div class="row">
		<?php echo $form->labelEx($model,'telefono2'); ?><br/>
        <?php echo $form->textField($model,'telefono2',array('class'=>'formelement longer','size'=>10,'maxlength'=>10)); ?>
        
    </div>
    <!--TEXT url_web-->
    <div class="row">
		<?php echo $form->labelEx($model,'url_web'); ?><br/>
        <?php echo $form->textField($model,'url_web',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    <!--TEXT url_blog-->
    <div class="row">
		<?php echo $form->labelEx($model,'url_blog'); ?><br/>
        <?php echo $form->textField($model,'url_blog',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    <!--TEXT facebook-->
    <div class="row">
		<?php echo $form->labelEx($model,'facebook'); ?><br/>
        <?php echo $form->textField($model,'facebook',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    <!--TEXT twitter-->
    <div class="row">
		<?php echo $form->labelEx($model,'twitter'); ?><br/>
        <?php echo $form->textField($model,'twitter',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    <!--TEXT foto-->
    <div class="row">
		<?php echo $form->labelEx($model,'foto'); ?><br/>
        <?php echo $form->textField($model,'foto',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
    
    <!--TEXTAREA foto-->
    <div class="row">
		<?php echo $form->labelEx($model,'info'); ?><br/>
		<?php echo $form->textField($model,'info',array('class'=>'formelement longer','size'=>200,'maxlength'=>200)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?><br/>
		<?php echo $form->passwordField($model,'pass',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pass_repeat'); ?><br/>
		<?php echo $form->passwordField($model,'pass_repeat',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'foto'); ?><br/>
        <?php echo $form->textField($model,'foto',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
    </div>
        
	<!--NO SE MUESTRA CUANDO EXISTE id-->
    <?php if (!isset($model->id)) { ?>
	<?php }?>
	<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear cuenta' : 'Guardar',array('class'=>'button big')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->