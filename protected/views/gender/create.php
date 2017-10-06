<?php
$this->breadcrumbs=array(
	'Genders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gender', 'url'=>array('index')),
	array('label'=>'Manage Gender', 'url'=>array('admin')),
);
?>

<h1>Create Gender</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>