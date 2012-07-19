<?php
class DatesController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new System_Model_Dates();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array(true, 'id', 'DESC'));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
	}
	
	public function detailsAction()
	{
		
	}
	
}