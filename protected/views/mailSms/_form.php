<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-sms-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
		<?php echo $form->error($model,'account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_group_id'); ?>
		<?php echo $form->textField($model,'to_group_id'); ?>
		<?php echo $form->error($model,'to_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_contact_id'); ?>
		<?php echo $form->textField($model,'to_contact_id'); ?>
		<?php echo $form->error($model,'to_contact_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_type'); ?>
		<?php echo $form->textField($model,'to_type'); ?>
		<?php echo $form->error($model,'to_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_type'); ?>
		<?php echo $form->textField($model,'sms_type'); ?>
		<?php echo $form->error($model,'sms_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message_body'); ?>
		<?php echo $form->textArea($model,'message_body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message_body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_sms_id'); ?>
		<?php echo $form->textField($model,'parent_sms_id'); ?>
		<?php echo $form->error($model,'parent_sms_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'org_name'); ?>
		<?php echo $form->textField($model,'org_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'org_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'int_field1'); ?>
		<?php echo $form->textField($model,'int_field1'); ?>
		<?php echo $form->error($model,'int_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'int_field2'); ?>
		<?php echo $form->textField($model,'int_field2'); ?>
		<?php echo $form->error($model,'int_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dbl_field1'); ?>
		<?php echo $form->textField($model,'dbl_field1'); ?>
		<?php echo $form->error($model,'dbl_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dbl_field2'); ?>
		<?php echo $form->textField($model,'dbl_field2'); ?>
		<?php echo $form->error($model,'dbl_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'varc_field1'); ?>
		<?php echo $form->textField($model,'varc_field1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'varc_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'varc_field2'); ?>
		<?php echo $form->textField($model,'varc_field2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'varc_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_field1'); ?>
		<?php echo $form->textArea($model,'txt_field1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'txt_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'txt_field2'); ?>
		<?php echo $form->textArea($model,'txt_field2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'txt_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dat_field1'); ?>
		<?php echo $form->textField($model,'dat_field1'); ?>
		<?php echo $form->error($model,'dat_field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dat_field2'); ?>
		<?php echo $form->textField($model,'dat_field2'); ?>
		<?php echo $form->error($model,'dat_field2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dat_field3'); ?>
		<?php echo $form->textField($model,'dat_field3'); ?>
		<?php echo $form->error($model,'dat_field3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dat_field4'); ?>
		<?php echo $form->textField($model,'dat_field4'); ?>
		<?php echo $form->error($model,'dat_field4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dat_field5'); ?>
		<?php echo $form->textField($model,'dat_field5'); ?>
		<?php echo $form->error($model,'dat_field5'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->