<script>
    $(document).ready(function(){
       $('#Actualizar_idPais').change(function(){
            $.ajax({
              type: "POST",
              url: "<?php echo $this->createUrl('paises/provincias');?>",
              data: "idPais="+$(this).val(),
              success: function(data){
                $('#Actualizar_idProvincia').html(data);
              }
            });
        });
           
    });
</script>
<style type="text/css">
<!--
	.row_foto{
	    border-left: 1px solid #1490E3;
        float: right;
        height: 837px;
        padding: 0 25px;
	}
    
    .izquierdo{
        float:left;
        height: 800px;
    }
    .row_buttons{
        float: left;
        margin-top: 52px;
        position: relative;
    }
    div.col1 {
    width: 530px !important;
    }
    div.col2 {
    float: right !important;
    width: 370px !important;
    }
    div.box {
    height: 900px;
    }
    
-->
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'fotografos-form',
'enableAjaxValidation'=>true,
'htmlOptions' => array('enctype' => 'multipart/form-data',
))); ?>


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
	
    <div class="izquierdo">
	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?><br/>
		<?php echo $form->textField($model,'nombre',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?><br/>
		<?php echo $form->textField($model,'apellido',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'email'); ?><br/>
		<?php echo $form->textField($model,'email',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
	</div>
    
    <!--SELECT PAISES-->
	<div class="row">
		<?php echo $form->labelEx($model,'idPais'); ?><br/>
        <?php /*echo $form->dropDownList($model,'idPais',CHtml::listData(Paises::model()->findAll(),'idPais','PAI_NOMBRE'),array('class'=>'formelement replacer','maxlength'=>50,'empty'=>'--Por favor escoja--', 'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('Paises/provincias'), //url to call.
                    'update'=>'#idProvincia', //selector to update
                    'data'=>array('idPais'=>'js:jQuery(this).parents("form").serialize()'),
                    ))); */?>
        <?php 
                echo $form->dropDownList($model,'idPais',
                CHtml::listData(Paises::model()->findAll(), 'idPais', 'PAI_NOMBRE'),
                array(
                'class'=>'formelement replacer','maxlength'=>50,'empty'=>'--Por favor escoja--'/*,*/                
                //'prompt' => '',
                /*'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=> $this->createUrl('paises/provincias'),  
                    'data'=>array('idPais'=>'js:this.value'),
                    'update'=>'idProvincia'
                )*/));
        ?>

    </div>
    <!--SELECT provincias-->
    <div class="row">
		<?php echo $form->labelEx($model,'idProvincia'); ?><br/>
        <?php if($model->isNewRecord){$form->dropDownList($model,'idProvincia',array('empty'=>'--Por favor escoja--'),array('class'=>'formelement replacer','maxlength'=>50));
              }else{
                echo $form->dropDownList($model,'idProvincia',
                CHtml::listData(Provincia::model()->findAll('idPais=:idpais',array(':idpais'=>$model->idPais)), 'idProvincia', 'prov_nombre'),
                array(
                'class'=>'formelement replacer','maxlength'=>50,'empty'=>'--Por favor escoja--'
                ));
              }  
         ?>
        
    </div>
    <!--SELECT localidad-->
    <div class="row">
		<?php echo $form->labelEx($model,'localidad'); ?><br/>
        <?php echo $form->textField($model,'localidad',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
        
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
        
    <!--TEXTAREA info-->
    <div class="row">
		<?php echo $form->labelEx($model,'info'); ?><br/>
		<?php echo $form->textArea($model,'info',array('class'=>'formelement longer','size'=>200,'maxlength'=>200)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?><br/>
		<?php echo $form->passwordField($model,'pass',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pass_repeat'); ?><br/>
		<?php echo $form->passwordField($model,'pass_repeat',array('value'=>'','class'=>'formelement replacer','maxlength'=>100)); ?>
		
	</div>
    </div>
    <!--FIN izquierdo-->
    <!--INPUT FOTO-->
    <div class="row_foto">
        <p>
        <span>Foto de Perfil</span>
        </p>
        <p>
        <a><img src="/upload/<?php echo $model->foto;?>" style="width: 100px; height: 100px; padding: 0 45px;"/></a>
        </p>
        <p>
        <?php //echo $form->labelEx($model,'foto'); ?><br/>
        <?php echo $form->fileField($model,'foto',array('class'=>'formelement replacer','size'=>13,'maxlength'=>100)); ?>
        </p>
    </div>
        
	<!--NO SE MUESTRA CUANDO EXISTE id-->
    <?php if (!isset($model->id)) { ?>
	<?php }?>
	<br/>
	<div class="row_buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear cuenta' : 'Guardar',array('class'=>'button big')); ?>
	</div>
 
<?php $this->endWidget(); ?>

</div><!-- form -->
