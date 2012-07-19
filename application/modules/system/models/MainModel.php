<?php
class System_Model_MainModel
{
	protected $_mapper;
	
	public function fetchAll2Array($userJoin = false, $sort = null, $direction = null, $where = null)
	{
		return $this->_mapper->fetchAll2Array($userJoin, $sort, $direction, $where);
	}
	
	public function find($id, $userJoin)
	{
		return $this->_mapper->find($id, $userJoin);
	}
	
	public function delete($id)
	{
		return $this->_mapper->delete($id);
	}
	
	public function save($data)
	{
		return $this->_mapper->save($data);
	}
}