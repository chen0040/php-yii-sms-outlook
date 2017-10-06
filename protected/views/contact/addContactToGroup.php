<?php $user=Yii::app()->accountMgr->getAccount(); ?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user, 'url'=>$url, 'field_id'=>$field_id, 'sub_field_id'=>$contact->id));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
?>

<?php if(isset($user)): ?>
<?php $groups=Group::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Groups').': '.$username; ?></li>
		
		<li data-role="list-divider">
		Please click any group below to have the contact <?php echo $contact->first_name.' '.$contact->last_name; ?> added to the group
		</li>
		
		<?php foreach($groups as $group): ?>			
			<?php if(!$group->hasContact($contact)): ?>
			<li>
			<a href="<?php echo Yii::app()->createUrl('groupContact/addContactToGroup', array('url'=>$url, 'field_id'=>$field_id, 'contact_id'=>$contact->id, 'group_id'=>$group->id)); ?>">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/'.($group->id % 6 + 1).'.jpg', 'Group'); ?> 
			<p><strong><?php echo $group->groupname; ?></strong></p>
			<p><?php echo $group->org_name; ?></p>
			<p><?php echo $group->description; ?></p>
			<span class="ui-li-count"><?php echo $group->getContactCount(); ?></span>
			<p class="ui-li-aside"><strong><?php echo $group->dat_field2; ?></strong></p>
			</a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>
