<?php 
$username=$model->username;
if(isset($model->first_name))
{
	$username=$model->first_name.' '.$model->last_name;
}
$data_divider_theme=$model->data_divider_theme(); 

$cs=Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl.'/scripts/datepicker/jquery.ui.datepicker.mobile.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/datepicker/jQuery.ui.datepicker.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/datepicker/jquery.ui.datepicker.mobile.js');
?>

<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
	<li data-role="list-divider"><?php echo Yii::t('translation', 'Calendar').': '.$username; ?></li>
	<li>
	<label for="date">Calendar Date:</label>
	<input type="date" name="date" id="date" value=""  />	
	</li>
</ul>
		

	