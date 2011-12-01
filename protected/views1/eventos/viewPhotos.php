<?php
$this->layout='public';


?>

<style>
div#content .container
{
	width:100%;
	float:left;
}

div#content .content
{
	padding:20px;
	
}
</style>
<div id="contentHeader">
	<div class="title"><span class="h1">Fotos del &aacute;lbum</span></div>
	<div class="name">	
		<span class="h1"><?php echo $model->nombre?></span><br/>
		<?php echo CHtml::link('Subir fotos', array('addPhotos', 'id'=>$model->id)); ?> | 
		<?php echo CHtml::link('Compartir', array('share', 'id'=>$model->id)); ?> |
		<?php echo CHtml::link('Editar info', array('update', 'id'=>$model->id)); ?>
	</div> 
</div>



<div id="fotos">
	<div class="col_left">
		<?php
		

		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_viewPhotos',
			'emptyText'=>'No existen fotos para el &aacute;lbum. Para subir nuevas fotos <a href="/eventos/addPhotos/id/' . $model->id . '">haz click aqui</a>.',
			'pager'=>array(
				'class'=>'CLinkPager',
				'header'=>'',
				'firstPageLabel'=>'&lt;&lt;',
				'prevPageLabel'=>'&lt;',
				'nextPageLabel'=>'&gt;',	
				'lastPageLabel'=>'&gt;&gt;',
				),
			'cssFile'=>false,
		));
		
		?>

	</div>
	<div class="col_right" id="col_right">
		<img src="/images/loading.gif">
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	
	$('#col_right').mouseenter(function() 
		{
		
	  		$('#photo_actions').slideDown('fast', function(){
	   		 // 	Animation complete.
	  		 });
	  	});
	
	$('#col_right').mouseleave(function() {
		  $('#photo_actions').slideToggle('fast', function() {
		    // Animation complete.
		  });
	});
})
</script>