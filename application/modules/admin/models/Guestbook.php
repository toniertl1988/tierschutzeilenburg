<?php
class Admin_Model_Guestbook extends Admin_Model_MainModel
{
	public function __construct()
	{
		$this->_mapper = new Admin_Model_GuestbookMapper();
		
	}	
}