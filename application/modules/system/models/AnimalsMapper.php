<?php
class System_Model_AnimalsMapper extends System_Model_MainMapper
{
	protected $_dbTable;

	public function __construct()
	{
		$this->_dbTable = new System_Model_DbTable_Animals();
	}
}