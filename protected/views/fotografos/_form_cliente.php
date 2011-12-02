<script>
    $(document).ready(function(){
       $('#Clientes_idPais').change(function(){
            $.ajax({
              type: "POST",
              url: "<?php echo $this->createUrl('paises/provincias');?>",
              data: "idPais="+$(this).val(),
              success: function(data){
                $('#Clientes_idProvincia').html(data);
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
        position: relative;
    }
    
    div.col1 {
    width: 450px !important;
    }
  
    div.col2 {
    float: right !important;
    width: 450px !important;
    }
    div.box {
    height: 695px;
    }
   .tpl-2col{
    margin-top: 0px;    
   }
   
   .menu_eventos{
    padding-bottom: 20px;
    text-align: center;
    }
   
   .escoger{
    
   }
   
   .menu_eventos .escoger ul li a{
    text-decoration: none;
    font-size:15px;
    color:#FFFFFF;
   }
   
   .menu_eventos .escoger ul li{
    -moz-border-radius: 7px 7px 7px 7px;
    background: url("../gfx/button_bg.png") repeat-x scroll center top #1490E3;
    border: 1px solid #1490E3;
    margin: 0 0 0 8px;
    padding: 0;
    display:inline;
    padding: 5px;
   }
   .persona{
    font-size: 18px;
    margin-bottom: 25px;
    padding: 0 140px;
   }
   
-->
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'clientes-form',
'enableAjaxValidation'=>true,
));
?>


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
    <div class="persona">
	   <span>Datos Novio</span>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_evento'); ?><br/>
		<?php echo $form->textField($model,'nombre_evento',array('class'=>'formelement replacer','maxlength'=>50)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?><br/>
		<?php echo $form->textField($model,'fecha',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'nombres'); ?><br/>
		<?php echo $form->textField($model,'nombres',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?><br/>
		<?php echo $form->textField($model,'apellidos',array('class'=>'formelement replacer','maxlength'=>50)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'email'); ?><br/>
		<?php echo $form->textField($model,'email',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'celular'); ?><br/>
		<?php echo $form->textField($model,'celular',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?><br/>
		<?php echo $form->textField($model,'telefono',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'domicilio'); ?><br/>
		<?php echo $form->textField($model,'domicilio',array('class'=>'formelement longer','size'=>100,'maxlength'=>100)); ?>
		
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
        <?php 
        if($model==''){$form->dropDownList($model,'idProvincia',array('empty'=>'--Por favor escoja--'),array('class'=>'formelement replacer','maxlength'=>50));
              }else{
                echo $form->dropDownList($model,'idProvincia',
                CHtml::listData(Provincia::model()->findAll('idPais=:idpais',array(':idpais'=>$model->idPais)), 'idProvincia', 'prov_nombre'),
                array(
                'class'=>'formelement replacer','maxlength'=>50,'empty'=>'--Por favor escoja--'
                ));
              }  
         ?>
        
    </div>
   
    <!--TEXTAREA notas-->
    <div class="row">
		<?php echo $form->labelEx($model,'notas'); ?><br/>
		<?php echo $form->textArea($model,'notas',array('class'=>'formelement longer','size'=>200,'maxlength'=>200)); ?>
		
	</div>
    
    <br/>
	<div class="row_buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Ingresar datos' : 'Guardar',array('class'=>'button big')); ?>
	</div>

    </div>
    <!--FIN izquierdo-->
    
    <!--NO SE MUESTRA CUANDO EXISTE id-->
    <?php if (!isset($model->id)) { ?>
	<?php }?>
	
 
<?php $this->endWidget(); ?>

</div><!-- form -->
