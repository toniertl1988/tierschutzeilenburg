<?php
class Admin_Model_MainModel
{
	protected $_mapper;
	
	public function fetchAll2Array($sort = null, $direction = null)
	{
		return $this->_mapper->fetchAll2Array($sort, $direction);
	}
	
	public function find($id)
	{
		return $this->_mapper->find($id);
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