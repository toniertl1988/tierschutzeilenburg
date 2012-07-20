<?php
class System_Model_MainMapper
{
	protected $_dbTable;
	
	public function fetchAll2Array($userJoin, $sort, $direction, $where)
	{
		$select = $this->_dbTable->select();
		if ($userJoin === true) {
			$select = $this->_createUserJoin($select);
		}
		if ($sort !== null && $direction !== null) {
			$select->order($sort . ' ' . $direction);
		}
		if ($where !== null) {
			$select->where($where);
		}
		return $this->_dbTable->fetchAll($select)->toArray();
	}
	
	public function find($id, $userJoin)
	{
		$select = $this->_dbTable->select();
		if ($userJoin === true) {
			$select = $this->_createUserJoin($select);
		}
		$select->where('id =?', $id);
		$result = $this->_dbTable->fetchAll($select)->toArray();
		return $result[0];
	}
	
	public function findByField($field, $value, $userJoin)
	{
		$select = $this->_dbTable->select();
		if ($userJoin === true) {
			$select = $this->_createUserJoin($select);
		}
		$select->where($field . ' = ?', $value);
		$result = $this->_dbTable->fetchAll($select)->toArray();
		return $result[0];
	}
	
	public function delete($id)
	{
		$where = $this->_dbTable->getAdapter()->quoteInto('id = ?', $id);
		$result = $this->_dbTable->delete($where);
		if (is_int($result) && $result !== 0) {
			return true;
		}
		return false;
	}
	
	public function save($data)
	{
		if (isset($data['id']) && $data['id'] !== 0) {
			$where = $this->_dbTable->getAdapter()->quoteInto('id =?', $data['id']);
			unset($data['id']);
			$result = $this->_dbTable->update($data, $where);
		} else {
			$result = $this->_dbTable->insert($data);
		}
		if (is_int($result) && $result !== 0) {
			return true;
		}
		return false;
	}
	
	protected function _createUserJoin($select)
	{
		$tableName = $this->_dbTable->getTableName();
		$select->setIntegrityCheck(false)
			   ->from(array('table' => $tableName))
		       ->join(array('u' => 'user'), 'table.user_id = u.id', array('realname' => 'u.realname'));
		return $select;
	}
}