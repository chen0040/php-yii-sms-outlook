<?php
$this->breadcrumbs=array(
	'Group Contacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupContact', 'url'=>array('index')),
	array('label'=>'Create GroupContact', 'url'=>array('create')),
	array('label'=>'View GroupContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupContact', 'url'=>array('admin')),
);
?>

<h1>Update GroupContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>