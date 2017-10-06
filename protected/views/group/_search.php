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
		<?php echo $form->label($model,'groupname'); ?>
		<?php echo $form->textField($model,'groupname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->