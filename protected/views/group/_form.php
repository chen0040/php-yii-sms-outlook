<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groupname'); ?>
		<?php echo $form->textField($model,'groupname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'groupname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
		<?php echo $form->error($model,'account_id'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->