<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupname')); ?>:</b>
	<?php echo CHtml::encode($data->groupname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_name')); ?>:</b>
	<?php echo CHtml::encode($data->org_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('int_field1')); ?>:</b>
	<?php echo CHtml::encode($data->int_field1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('int_field2')); ?>:</b>
	<?php echo CHtml::encode($data->int_field2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dbl_field1')); ?>:</b>
	<?php echo CHtml::encode($data->dbl_field1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dbl_field2')); ?>:</b>
	<?php echo CHtml::encode($data->dbl_field2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varc_field1')); ?>:</b>
	<?php echo CHtml::encode($data->varc_field1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varc_field2')); ?>:</b>
	<?php echo CHtml::encode($data->varc_field2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_field1')); ?>:</b>
	<?php echo CHtml::encode($data->txt_field1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txt_field2')); ?>:</b>
	<?php echo CHtml::encode($data->txt_field2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dat_field1')); ?>:</b>
	<?php echo CHtml::encode($data->dat_field1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dat_field2')); ?>:</b>
	<?php echo CHtml::encode($data->dat_field2); ?>
	<br />

	*/ ?>

</div>