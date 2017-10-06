<?php
$this->breadcrumbs=array(
	'Mail Sms',
);

$this->menu=array(
	array('label'=>'Create MailSms', 'url'=>array('create')),
	array('label'=>'Manage MailSms', 'url'=>array('admin')),
);
?>

<h1>Mail Sms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
