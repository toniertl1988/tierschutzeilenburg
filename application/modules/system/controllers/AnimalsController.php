<?php
class AnimalsController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new System_Model_Animals();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array(false, 'id', 'DESC', 'adopted IS NULL'));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;		
	}
	
	public function detailsAction()
	{
		
	}
}