<?php
class Admin_Form_News extends Zend_Form
{
	protected $_data;

	public function __construct($data = null)
	{
		if (is_array($data)) {
			$this->_data = $data;
		} else {
			$this->_data = array();
		}
		parent::__construct();
	}
	
	public function init()
	{
		$this->addElement('text', 'title', array('label' => 'Titel'));
		$this->addElement('textarea', 'content', array('label' => 'Content'));
		$this->addElement('submit', 'submit', array('label' => 'Abschicken'));
		$this->populate($this->_data);
	}
}