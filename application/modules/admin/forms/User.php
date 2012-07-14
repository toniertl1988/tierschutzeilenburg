<?php
class Admin_Form_User extends Zend_Form
{
	protected $_data;
	
	protected $_roles;

	public function __construct($role, $data = null)
	{
		if (is_array($data)) {
			$this->_data = $data;
		} else {
			$this->_data = array();
		}
		if ($role == 'admin') {
			$this->_roles = array('admin' => 'admin', 'member' => 'member');
		} else {
			$this->_roles = array('member' => 'member');
		}
		parent::__construct();
	}
	
	public function init()
	{
		$this->addElement('text', 'username', array('label' => 'Username'));
		$this->addElement('text', 'realname', array('label' => 'Anzeigename'));
		$this->addElement('password', 'password', array('label' => 'Passwort'));
		$this->addElement('text', 'email', array('label' => 'E-Mail Adresse'));
		$this->addElement('select', 'role', array('label' => 'Rolle', 'multiOptions' => $this->_roles));
		$this->addElement('submit', 'submit', array('label' => 'Abschicken'));
		$this->populate($this->_data);
	}
}