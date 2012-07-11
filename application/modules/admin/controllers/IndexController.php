<?php
class IndexController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->layout->setLayout('adminlayout');
	}
	
	public function indexAction()
	{
		echo "admin / index";
	}
}