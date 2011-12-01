<?php
$this->layout='public';
?>

<h1>Mis &aacute;lbums</h1> 
<div style="float:right;"><a href="create" class="button">Crear nuevo &aacute;lbum</a></div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'emptyText'=>'No tienes &aacute;lbums creados. Para crear tu primer &aacute;lbum <a href="create">haz click aqui</a>.',
)); ?>
