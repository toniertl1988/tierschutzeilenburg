<?php
class Admin_AnimalsController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new Admin_Model_Animals();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array());
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
	}
	
	public function editAction()
	{
		if (!$this->_hasParam('id')) {
			$this->_helper->redirector('index');
		} else {
			$id = intval($this->_getParam('id'));
			if ($id === 0) {
				$this->_helper->redirector('index');
			} else {
				$model = new Admin_Model_Animals();
				$data = $model->find($id);
				if (empty($data)) {
					$this->_helper->redirector('index');
				} else {
					$form = new Admin_Form_Animal($data);
					if ($this->getRequest()->isPost()) {
						$post = $this->getRequest()->getPost();
						if ($form->isValid($post)) {
							unset($post['submit']);
							foreach ($post AS $key => $value) {
								if (strlen($value) !== 0) {
									$data[$key] = $value;
								}
							}
							$model->save($data);
						} else {
							$this->populate($post);
						}
					}
					$this->view->form = $form;
				}
			}
		}
	}
	
	public function deleteAction()
	{
		if (!$this->_hasParam('id')) {
			$this->_helper->redirector('index');
		} else {
			$id = intval($this->_getParam('id'));
			if ($id === 0) {
				$this->_helper->redirector('index');
			} else {
				$model = new Admin_Model_Animals();
				$result = $model->delete($id);
				$this->_helper->redirector('index');
			}
		}
	}
	
	public function addAction()
	{
		$form = new Admin_Form_Animal();
		$model = new Admin_Model_Animals();
		if ($this->getRequest()->isPost()) {
			$post = $this->getRequest()->getPost();
			if ($form->isValid($post)) {
				
				unset($post['submit']);
				$data = array();
				foreach ($post AS $key => $value) {
					if (strlen($value) !== 0) {
						$data[$key] = $value;
					}
				}
				$model->save($data);
			} else {
				$this->populate($post);
			}
		}
		$this->view->form = $form;
	}
}