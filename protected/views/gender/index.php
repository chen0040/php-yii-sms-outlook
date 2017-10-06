<?php
$this->breadcrumbs=array(
	'Genders',
);

$this->menu=array(
	array('label'=>'Create Gender', 'url'=>array('create')),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1>Genders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
