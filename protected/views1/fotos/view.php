<?php


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
  $this->layout='empty';
  // get the parameter passed via ajax from the _form.php
  
  
  if (isset($_POST['first']))
  {
  	if ($_POST['first'] == 'false')
  	{
  		//echo "hola";
  		//echo $_POST['first'];
  		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
  		Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
  		
  		
  	}
  	
  }

  
}
else
{
	$this->layout='public';
}
	


$photo_name = substr(strrchr($model->path, "/"), 1);
$photo = '/gallery/evento' . $model->idEvento . '/thumb/' . $photo_name;
$main_photo = '/gallery/evento' . $model->idEvento . '/regular/' . $photo_name;
$full_photo_url = $this->createAbsoluteUrl('fotos/view/',array('id'=>$model->id));

$share_id = 'share_dialog_' . $model->id;
$update_id = 'update_dialog_' . $model->id;
$delete_id = 'delete_dialog_' . $model->id;
?>
<div id="photo">
	<div class="image">
		<img src="<?php echo $main_photo?>" id="main_photo" border="0">
		<br/><br/><br/>
		<span id="image_title"><?php echo $model->titulo?></span>
	</div>
	<div id="photo_actions">
		<div class="actions">
			Ver:<br/>
			<div class="image_actions"><a id="main_photo_l" href="">Grande</a> | <a id="main_photo_o" href="">Original</a><br/><br/></div>
			Compartir:<br/>
			<iframe id="share_facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo $full_photo_url?>&amp;layout=button_count&amp;show_faces=false&amp;width=55&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:55px; height:21px;" ></iframe><a id="share_twitter" href='http://twitter.com/home?status=Les comparto esta foto subida a Web Album Pro: <?php echo $full_photo_url?>' target='blank'><img border="0" src="/images/icon_twitter.png"></a> <img style="cursor:pointer;" onclick="javascript:$('#mensaje_<?php echo $model->id ?>').hide();$('#<?php echo $share_id?>').dialog('open');" border="0" src="/images/icon_mail.png"><br/><br/>
			<span style="cursor:pointer;" onclick="javascript:$('#mensaje_update_<?php echo $model->id ?>').hide();$('#<?php echo $update_id?>').dialog('open');">Actualizar t&iacute;tulo</span><br/>
			<span style="cursor:pointer;" onclick="javascript:$('#mensaje_delete_<?php echo $model->id ?>').hide();$('#<?php echo $delete_id?>').dialog('open');">Eliminar</span><br/>
		</div>
	</div>
	
</div>
<?php 


$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>$share_id,
                'options'=>array(
					'title'=>'Compartir foto',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'560',
                    'height'=>'390',
					'draggable'=>false,
                    'resizable'=>false,
                    'closeOnEscape' => true,
                ),
                ));
echo $this->renderPartial('/fotos/share', array('model'=>$model));
$this->endWidget('zii.widgets.jui.CJuiDialog');

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>$delete_id,
                'options'=>array(
					'title'=>'Eliminar foto',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'560',
                    'height'=>'390',
					'draggable'=>false,
                    'resizable'=>false,
                    'closeOnEscape' => true,
                ),
                ));
echo $this->renderPartial('/fotos/delete', array('model'=>$model));
$this->endWidget('zii.widgets.jui.CJuiDialog');

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>$update_id,
                'options'=>array(
					'title'=>'Actualizar t&iacute;tulo',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'560',
                    'height'=>'390',
					'draggable'=>false,
                    'resizable'=>false,
                    'closeOnEscape' => true,
                ),
               
                ));
echo $this->renderPartial('/fotos/update', array('model'=>$model));
$this->endWidget('zii.widgets.jui.CJuiDialog');
 
// import the extension
Yii::import('ext.jqPrettyPhoto');
 
$options = array(
    'slideshow'=>5000,
    'autoplay_slideshow'=>false, 
    'show_title'=>false
);

// call addPretty static function
jqPrettyPhoto::addPretty('.image a',jqPrettyPhoto::PRETTY_SINGLE,jqPrettyPhoto::THEME_FACEBOOK, $options);
jqPrettyPhoto::addPretty('.image_actions a',jqPrettyPhoto::PRETTY_SINGLE,jqPrettyPhoto::THEME_FACEBOOK, $options);
	
?>

<style>
#<?php echo $share_id?>{display:none;}
#<?php echo $update_id?>{display:none;}
#<?php echo $delete_id?>{display:none;}
</style>