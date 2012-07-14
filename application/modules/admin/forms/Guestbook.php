<?php
class Admin_Form_Guestbook extends Zend_Form
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
		$this->addElement('textarea', 'comment', array('label' => 'Kommentar'));
		$this->addElement('submit', 'submit', array('label' => 'Abschicken'));
		$this->populate($this->_data);
	}
}