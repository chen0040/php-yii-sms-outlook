<?php
$this->breadcrumbs=array(
	'Genders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Gender', 'url'=>array('index')),
	array('label'=>'Create Gender', 'url'=>array('create')),
	array('label'=>'Update Gender', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gender', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1>View Gender #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gender_name',
	),
)); ?>
