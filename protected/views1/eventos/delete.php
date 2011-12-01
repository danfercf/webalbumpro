<div id="share_foto">
	<div class="box">
			<?php 
			
			echo "<div id='mensaje_delete_" . $model->id . "' class='mensaje' style='display:none;'>El &aacute;lbum ha sido eliminado</div>";
			
			$form=$this->beginWidget('CActiveForm', array(
        		'id'=>'delete-form',
        		'enableAjaxValidation'=>true,
        		'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
				)); ?>
			
			
			
				<div class="row">
					Est&aacute;s seguro que deseas eliminar el &aacute;lbum?
				</div>
			
				<br/>
				<div class="row buttons">
					<?php echo CHtml::ajaxSubmitButton(
						'Si, eliminar',
						CHtml::normalizeUrl(array('delete','id'=>$model->id)),
						array(
							'success'=>'js:imageDeleted()',
								
						),
						array('class'=>'button red','name'=>'delete_' . $model->id)); ?>
						
				</div>
			
			<?php $this->endWidget(); ?>
		</div>
	</div>
<script type="text/javascript">
function imageDeleted()
{
	$("#mensaje_delete_<?php echo $model->id?>").show();
	$("#<?php echo $model->id?>").remove();
	
}
</script>