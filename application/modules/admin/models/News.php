<?php
class Admin_Model_News extends Admin_Model_MainModel
{
	public function __construct()
	{
		$this->_mapper = new Admin_Model_NewsMapper();
		
	}	
}