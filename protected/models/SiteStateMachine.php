<?php
	class SiteStateMachine
	{
		const FIELD_OUTBOX=1;
		const FIELD_DRAFT=2;
		const FIELD_SENT=3;
		const FIELD_CONTACTS=4;
		const FIELD_GROUPS=5;
		const FIELD_TRASH=6;
		const FIELD_CALENDAR=7;
		const FIELD_TASK=8;
		const FIELD_SETTINGS=9;
		const NOT_APPLICABLE_ID=-1;
		const FIELD_ERROR=10;
		
		public $field_id;
		public $sub_field_id;
		public $page_sub_field_id_max;
		public $page_sub_field_id_min;
		public $stack_id;
		
		public $url;
		
		public function __construct()
		{
			$this->field_id=SiteStateMachine::FIELD_OUTBOX;
			$this->sub_field_id=SiteStateMachine::NOT_APPLICABLE_ID;
			$this->page_sub_field_id_max = SiteStateMachine::NOT_APPLICABLE_ID;
			$this->page_sub_field_id_min = SiteStateMachine::NOT_APPLICABLE_ID;
			
			$this->stack_id=0;
			$this->url='';
		}
	}
