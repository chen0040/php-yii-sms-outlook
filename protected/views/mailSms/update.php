<?php
$this->breadcrumbs=array(
	'Mail Sms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MailSms', 'url'=>array('index')),
	array('label'=>'Create MailSms', 'url'=>array('create')),
	array('label'=>'View MailSms', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MailSms', 'url'=>array('admin')),
);
?>

<h1>Update MailSms <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>