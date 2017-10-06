<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Contact', 'url'=>array('index')),
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Update Contact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
);
?>

<h1>View Contact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'account_id',
		'first_name',
		'last_name',
		'gender_id',
		'race',
		'nationality',
		'address_line1',
		'address_line2',
		'address_line3',
		'address_line4',
		'postal',
		'country_id',
		'province',
		'email1',
		'email2',
		'country_code1',
		'country_code2',
		'area_code1',
		'area_code2',
		'phone1',
		'phone2',
		'create_time',
		'update_time',
		'last_login_time',
		'description',
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
