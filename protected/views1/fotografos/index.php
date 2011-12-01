<?php
$this->breadcrumbs=array(
	'Fotografoses',
);

$this->menu=array(
	array('label'=>'Create Fotografos', 'url'=>array('create')),
	array('label'=>'Manage Fotografos', 'url'=>array('admin')),
);
?>

<h1>Fotografoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
