<?php
class Admin_Model_MainMapper
{
	protected $_dbTable;
	
	public function fetchAll2Array($sort, $direction)
	{
		$select = $this->_dbTable->select();
		if ($sort !== null && $direction !== null) {
			$select->order($sort . ' ' . $direction);
		}
		return $this->_dbTable->fetchAll($select)->toArray();
	}
	
	public function find($id)
	{
		$select = $this->_dbTable->select()->where('id =?', $id);
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
}