<?php
class System_Model_Dates extends System_Model_MainModel
{
	public function __construct()
	{
		$this->_mapper = new System_Model_DatesMapper();
		
	}	
}