

<h1>Buscar evento</h1>

 
<?php echo $this->renderPartial('_search', array('model'=>$model)); ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_searchResult',
	'emptyText'=>'No tienes eventos creados. Utiliza el menu de la derecha para crear tu primer evento.',
)); ?>