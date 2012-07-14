<?php
class Admin_Model_NewsMapper extends Admin_Model_MainMapper
{
	protected $_dbTable;

	public function __construct()
	{
		$this->_dbTable = new System_Model_DbTable_News();
	}
}