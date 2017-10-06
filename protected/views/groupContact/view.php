<?php
$this->breadcrumbs=array(
	'Group Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupContact', 'url'=>array('index')),
	array('label'=>'Create GroupContact', 'url'=>array('create')),
	array('label'=>'Update GroupContact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupContact', 'url'=>array('admin')),
);
?>

<h1>View GroupContact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'contact_id',
		'account_id',
		'description',
		'org_name',
		'int_field1',
		'int_field2',
		'dbl_field1',
		'dbl_field2',
		'varc_field1',
		'varc_field2',
		'txt_field1',
		'txt_field2',
		'dat_field1',
		'dat_field2',
	),
)); ?>
