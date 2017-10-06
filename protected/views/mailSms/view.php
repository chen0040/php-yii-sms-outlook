<?php
$this->breadcrumbs=array(
	'Mail Sms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MailSms', 'url'=>array('index')),
	array('label'=>'Create MailSms', 'url'=>array('create')),
	array('label'=>'Update MailSms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MailSms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MailSms', 'url'=>array('admin')),
);
?>

<h1>View MailSms #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'status',
		'account_id',
		'to_group_id',
		'to_contact_id',
		'to_type',
		'sms_type',
		'message_body',
		'parent_sms_id',
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
		'dat_field3',
		'dat_field4',
		'dat_field5',
	),
)); ?>
