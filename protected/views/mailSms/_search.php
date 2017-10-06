<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_group_id'); ?>
		<?php echo $form->textField($model,'to_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_contact_id'); ?>
		<?php echo $form->textField($model,'to_contact_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_type'); ?>
		<?php echo $form->textField($model,'to_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_type'); ?>
		<?php echo $form->textField($model,'sms_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message_body'); ?>
		<?php echo $form->textArea($model,'message_body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_sms_id'); ?>
		<?php echo $form->textField($model,'parent_sms_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'org_name'); ?>
		<?php echo $form->textField($model,'org_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'int_field1'); ?>
		<?php echo $form->textField($model,'int_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'int_field2'); ?>
		<?php echo $form->textField($model,'int_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dbl_field1'); ?>
		<?php echo $form->textField($model,'dbl_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dbl_field2'); ?>
		<?php echo $form->textField($model,'dbl_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varc_field1'); ?>
		<?php echo $form->textField($model,'varc_field1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varc_field2'); ?>
		<?php echo $form->textField($model,'varc_field2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_field1'); ?>
		<?php echo $form->textArea($model,'txt_field1',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'txt_field2'); ?>
		<?php echo $form->textArea($model,'txt_field2',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dat_field1'); ?>
		<?php echo $form->textField($model,'dat_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dat_field2'); ?>
		<?php echo $form->textField($model,'dat_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dat_field3'); ?>
		<?php echo $form->textField($model,'dat_field3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dat_field4'); ?>
		<?php echo $form->textField($model,'dat_field4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dat_field5'); ?>
		<?php echo $form->textField($model,'dat_field5'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->