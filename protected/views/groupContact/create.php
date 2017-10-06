<?php
$this->breadcrumbs=array(
	'Group Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupContact', 'url'=>array('index')),
	array('label'=>'Manage GroupContact', 'url'=>array('admin')),
);
?>

<h1>Create GroupContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>