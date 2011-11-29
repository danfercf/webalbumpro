<?php 
$delete_id = 'delete_dialog_' . $data->id;
?>
<div class="view" id="<?php echo $data->id ?>">
	<div class="eventPhoto">
		<?php 
		
		//echo "<pre>";
		//echo var_dump($data);
		//echo "<pre/>";
		
		echo CHtml::image($data->mainPhoto,NULL,array('class'=>'eventPhoto'));
		?>
		
	</div>
	<div class="eventData">
		<?php echo CHtml::link(CHtml::encode($data->nombre), array('viewPhotos', 'id'=>$data->id),array('class'=>'eventName')); ?>
		<br />
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
		<?php echo CHtml::encode($data->fecha); ?> | 
		
		<?php 
		if ($data->pass != '') 
			echo "<img src='/images/lock_closed.png' alt='Album protegido con contrase&ntilde;a'>";
		else
			echo "<img src='/images/lock_open.png' alt='Album sin contrase&ntilde;a'>";
		?>
		<br />
		<?php echo CHtml::link('Ver fotos', array('viewPhotos', 'id'=>$data->id)); ?> | 
		<?php echo CHtml::link('Subir fotos', array('addPhotos', 'id'=>$data->id)); ?> | 
		<?php echo CHtml::link('Compartir', array('share', 'id'=>$data->id)); ?> |
		<?php echo CHtml::link('Editar info', array('update', 'id'=>$data->id)); ?> |
		<span class="link" style="cursor:pointer;" onclick="javascript:$('#mensaje_delete_<?php echo $data->id ?>').hide();$('#<?php echo $delete_id?>').dialog('open');">Eliminar</span><br/>
	</div>


</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>$delete_id,
                'options'=>array(
					'title'=>'Eliminar foto',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'560',
                    'height'=>'250',
					'draggable'=>false,
                    'resizable'=>false,
                    'closeOnEscape' => true,
                ),
                ));
echo $this->renderPartial('delete', array('model'=>$data));
$this->endWidget('zii.widgets.jui.CJuiDialog');

?>

<style>
#<?php echo $delete_id?>{display:none;}
</style>