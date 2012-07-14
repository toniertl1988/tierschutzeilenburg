<?php
class Admin_NewsController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new Admin_Model_News();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array('id', 'DESC'));
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
				$model = new Admin_Model_News();
				$data = $model->find($id);
				if (empty($data)) {
					$this->_helper->redirector('index');
				} else {
					$form = new Admin_Form_News($data);
					if ($this->getRequest()->isPost()) {
						$post = $this->getRequest()->getPost();
						if ($form->isValid($post)) {
							unset($post['submit']);
							foreach ($post AS $key => $value) {
								$data[$key] = $value;
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
				$model = new Admin_Model_News();
				$result = $model->delete($id);
				$this->_helper->redirector('index');
			}
		}
	}
	
	public function addAction()
	{
		$form = new Admin_Form_News($data);
		$model = new Admin_Model_News();
		if ($this->getRequest()->isPost()) {
			$post = $this->getRequest()->getPost();
			if ($form->isValid($post)) {
				// eingeloggten User als Poster hinzufuegen
				$auth = Zend_Auth::getInstance();
				
				unset($post['submit']);
				$data = array();
				$data['user_id'] = $auth->getIdentity()->id;
				foreach ($post AS $key => $value) {
					$data[$key] = $value;
				}
				$model->save($data);
			} else {
				$this->populate($post);
			}
		}
		$this->view->form = $form;
	}
}