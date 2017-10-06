<?php
$this->breadcrumbs=array(
	'Group Contacts',
);

$this->menu=array(
	array('label'=>'Create GroupContact', 'url'=>array('create')),
	array('label'=>'Manage GroupContact', 'url'=>array('admin')),
);
?>

<h1>Group Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
