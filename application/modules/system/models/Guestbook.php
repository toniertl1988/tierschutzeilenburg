<?php
class System_Model_Guestbook extends System_Model_MainModel
{
	public function __construct()
	{
		$this->_mapper = new System_Model_GuestbookMapper();
		
	}	
}