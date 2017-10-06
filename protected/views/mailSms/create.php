<?php
$this->breadcrumbs=array(
	'Mail Sms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MailSms', 'url'=>array('index')),
	array('label'=>'Manage MailSms', 'url'=>array('admin')),
);
?>

<h1>Create MailSms</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>