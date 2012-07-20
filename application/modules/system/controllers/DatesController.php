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
		if (!$this->_hasParam('id')) {
			$this->_helper->redirector('index');
		} else {
			$id = intval($this->_getParam('id'));
			if ($id === 0) {
				$this->_helper->redirect('index');
			} else {
				$model = new System_Model_Dates();
				$result = $model->find($id, true);
				if (empty($result)) {
					$this->_helper->redirect('index');
				} else {
					$this->view->result = $result;
				}
			}
		}
	}
	
}