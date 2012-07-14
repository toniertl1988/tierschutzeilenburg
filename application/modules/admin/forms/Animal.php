<?php
class Admin_Form_Animal extends Zend_Form
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
		$this->addElement('text', 'name', array('label' => 'Name'));
		$this->addElement('text', 'species', array('label' => 'Tierart'));
		$this->addElement('text', 'race', array('label' => 'Rasse'));
		$this->addElement('text', 'birth', array('label' => 'Geburtsdatum (ca.)', 'readOnly' => 'true'));
		$this->addElement('text', 'arrive', array('label' => 'Ankunft im Tierheim', 'readOnly' => 'true'));
		$this->addElement('text', 'title', array('label' => 'Titel (z.b. Alte Katze sucht...)'));
		$this->addElement('select', 'wanted', array('label' => 'gesucht wird', 'multiOptions' => array('B' => 'zu Hause oder Pate', 'G' => 'Pate', 'H' => 'zu Hause')));
		$this->addElement('text', 'adopted', array('label' => 'adoptiert am', 'readOnly' => 'true'));
		$this->addElement('text', 'godparents', array('label' => 'Pate (Name)'));
		$this->addElement('text', 'since', array('label' => 'hat Pate seit', 'readOnly' => 'true'));
		$this->addElement('textarea', 'description', array('label' => 'Beschreibung'));
		$this->addElement('submit', 'submit', array('label' => 'Abschicken'));
		$this->populate($this->_data);
	}
}