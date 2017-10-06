<?php 
$user=Yii::app()->accountMgr->getAccount(); 
Yii::app()->accountMgr->applyLanguage();
?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
if(!isset($id))
{
	$id=-1;
}
?>

<?php if(isset($user)): ?>
<form id="target-form" method="post" action="<?php echo Yii::app()->createUrl($this->getId().'/'.$this->getAction()->getId(), array('url'=>$url, 'field_id'=>$field_id, 'id'=>$id)); ?>" data-ajax="false">
<input type="hidden" name="recipients" id="recipients" value="<?php echo $recipients; ?>" />
<input type="hidden" name="send_time" id="send_time" value="<?php echo $send_time; ?>" />
<input type="hidden" name="message_body" id="message_body" value="<?php echo $message_body; ?>" />
<input type="hidden" name="addGroupId" id="addGroupId" value="" />			
<?php $groups=Group::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Groups').': '.$username; ?>
			
		</li>
		
		<li data-role="list-divider">
		<?php echo Yii::t('translation', 'Please click any group below to have the group added to the SMS'); ?>
		<a href="#" onclick="cancelAddGroupToMailSms(); return false;" data-icon="back" data-role="button" data-inline="true" class="cancel-btn">
		<?php echo Yii::t('translation', 'Cancel'); ?>
		</a>
		</li>
		
		<?php foreach($groups as $group): ?>			
			<?php if(!$model->hasGroup($group)): ?>
			<li>
			<a href="#" onclick="addGroupToMailSms(<?php echo $group->id; ?>); return false;"><?php echo $group->groupname; ?></a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</form>
<script type="text/javascript">
function addGroupToMailSms(group_id)
{	
	$("#addGroupId").val(group_id);
	$("#target-form").submit();
}
function cancelAddGroupToMailSms()
{
	$("#addGroupId").val('');
	$("#target-form").submit();
}
</script>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>


