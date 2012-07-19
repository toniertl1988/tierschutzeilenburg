<?php
class System_Model_NewsMapper extends System_Model_MainMapper
{
	protected $_dbTable;

	public function __construct()
	{
		$this->_dbTable = new System_Model_DbTable_News();
	}
}