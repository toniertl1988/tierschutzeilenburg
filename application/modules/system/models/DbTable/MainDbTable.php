<?php
class System_Model_DbTable_MainDbTable extends Zend_Db_Table_Abstract
{
	public function getTableName()
	{
		return $this->_name;
	}
}