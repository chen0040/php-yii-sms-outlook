</div>

<?php
$data_theme='a'; 
if(isset($user))
{
	$data_theme=$user->footer_data_theme();
}
?>

<div data-role="footer" data-theme="<?php echo $data_theme; ?>">
	<p>
	<table style="width:100%">
	<tr>
	<td><?php echo Yii::t('translation', 'Contact Us'); ?>: 0000000000</td>
	<td style="text-align:right"><?php echo Yii::t('translation', 'Email Us'); ?>: <?php echo CHtml::mailto('contact_us@viaidea.com'); ?></td>
	</tr>
	</table>
	</p>
</div>

	
</div><!-- /page one -->

