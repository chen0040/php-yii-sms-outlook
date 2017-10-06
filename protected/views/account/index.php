<?php $user=Yii::app()->accountMgr->getAccount(); ?>

<?php
$this->renderPartial('../site/_pageStart', array('user'=>$user, 'url'=>$url, 'field_id'=>$field_id));
$data_divider_theme=$user->data_divider_theme();
$username=$user->username;
?>

<?php if(isset($user)): ?>
<?php $accounts=Account::model()->findAll(); ?>
	<ul data-role="listview" data-theme="c" data-dividertheme="<?php echo $data_divider_theme; ?>">
		<li data-role="list-divider"><?php echo Yii::t('translation', 'Groups').': '.$username; ?></li>
		
		<li data-role="list-divider">
		Please click any account below to view the details
		</li>
		
		<?php foreach($accounts as $account): ?>			
			<li>
			<a href="<?php echo Yii::app()->createUrl('account/update', array('url'=>$url, 'field_id'=>$field_id, 'id'=>$account->id)); ?>" data-rel="dialog" data-transition="pop">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/'.($account->id % 6 + 1).'.jpg', 'Account'); ?> 
			<p><strong><?php echo $account->username; ?></strong></p>
			<p><?php echo $account->first_name.' '.$account->last_name; ?></p>
			<p><?php echo $account->description; ?>
			(
			<?php if($account->isSuspended()): ?>
			<?php echo Yii::t('translation', 'This account is suspended'); ?>
			<?php else: ?>
			<?php echo Yii::t('translation', 'This account is active'); ?>
			<?php endif; ?>
			)
			</p>
			<span class="ui-li-count">
			
			<?php 
				if($account->isAdmin())
				{
					echo 'No Expiration Date';
				}
				else
				{
					if($account->hasExpired())
					{
						echo 'Expired';
					}
					else
					{
						echo 'Expired after: '.$account->getRemainingDays().' days'; 
					}
				}
			?>
			
			</span>
			<p class="ui-li-aside"><strong>
			<?php 
				if($account->isAdmin())
				{
					echo 'Admin';
				}
				else
				{
					echo 'Expired on '.$account->getExpiryDate(); 
				}
			?>
			</strong></p>
			</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
<?php $this->renderPartial('../site/_guestPage'); ?>
<?php endif; ?>

<?php 
$this->renderPartial('../site/_pageEnd', array('user'=>$user));
?>
