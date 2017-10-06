<?php
$this->breadcrumbs=array(
	'Mail Sms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MailSms', 'url'=>array('index')),
	array('label'=>'Create MailSms', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mail-sms-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mail Sms</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-sms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id',
		'status',
		'account_id',
		'to_group_id',
		'to_contact_id',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
