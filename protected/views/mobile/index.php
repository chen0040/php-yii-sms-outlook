<?php 
$user=Yii::app()->accountMgr->getAccount(); 

if(!isset($search_keywords))
{
	$search_keywords='';
}

$state_machine=new SiteStateMachine;
$state_machine->url='mobile/index';
if(isset($_GET['field_id']))
{
	$state_machine->field_id=$_GET['field_id'];
}
else
{
	$state_machine->field_id=SiteStateMachine::FIELD_OUTBOX;
}
if(isset($_GET['sub_field_id']))
{
	$state_machine->sub_field_id=$_GET['sub_field_id'];
}
else
{
	$state_machine->sub_field_id=SiteStateMachine::NOT_APPLICABLE_ID;
}

if(isset($_GET['page_sub_field_id_max']))
{
	$state_machine->page_sub_field_id_max=$_GET['page_sub_field_id_max'];
}
else
{
	$state_machine->page_sub_field_id_max=SiteStateMachine::NOT_APPLICABLE_ID;
}

if(isset($_GET['page_sub_field_id_min']))
{
	$state_machine->page_sub_field_id_min=$_GET['page_sub_field_id_min'];
}
else
{
	$state_machine->page_sub_field_id_min=SiteStateMachine::NOT_APPLICABLE_ID;
}

if(isset($_GET['stack_id']))
{
	$state_machine->stack_id=$_GET['stack_id'];
}
else
{
	$state_machine->stack_id=0;
}
$this->renderPartial('_pageStart', array('user'=>$user, 'state_machine'=>$state_machine));
?>

<?php
if(isset($user))
{
	$this->renderPartial('_mailbox', array('user'=>$user, 'state_machine'=>$state_machine, 'search_keywords'=>$search_keywords));
}
else
{
	$this->renderPartial('_guestPage');
}
?>

<?php 
$this->renderPartial('_pageEnd', array('user'=>$user));
?>