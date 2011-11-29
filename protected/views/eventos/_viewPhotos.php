<div class="viewPhoto" id="<?php echo $data->id ?>">
	<?php 
	
		$photo_name = substr(strrchr($data->path, "/"), 1);
				
		$photo = '/gallery/evento' . $data->idEvento . '/thumb/' . $photo_name;
		
		if ($index == 0)
		{
			?>
			<script type="text/javascript">
				$(document).ready(function()
						{
					<?php 
							 echo CHtml::ajax(array(
                				'update'=>'#col_right',
							 	'data'=>array('first'=>true),
 								'url'=>CController::createUrl('fotos/view', array('id'=>$data->id)),
                				'type'=>'post',),
                        		array('div'=>'js:$(this)', 'id'=>'shout-ajax-'.$data->id,)

									).' return false;'
							
							 ?>
							
						})
						
				
			</script>
			<?php 
		}
		
		
		?>
		
		
		<?php 
			
			echo CHtml::link(
            CHtml::image($photo,NULL,array("class"=>"photoThumb","width"=>"150px")),        
            CController::createUrl('fotos/view', array('id'=>$data->id)),
            array('onClick'=>' {'. CHtml::ajax(
 				array(
                'update'=>'#col_right',
 				'beforeSend'=>'function(){
                   $("#main_photo").attr("src","/images/loading.gif");
                }',
 				'data'=>array('first'=>false),
 				'url'=>CController::createUrl('fotos/view', array('id'=>$data->id)),
                'type'=>'post',),
                 array('div'=>'js:$(this)', 'id'=>'shout-ajax-'.$data->id,)

				).' return false; }'

				) 
           
      	 );
			
			
			
		?>
		
</div>