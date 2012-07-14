<?php
class Admin_UserController extends Zend_Controller_Action
{
	protected $_auth;
	
	public function init()
	{
		$auth = Zend_Auth::getInstance();
		$this->_auth = $auth->getIdentity();
	}

	public function indexAction()
	{
		$model = new Admin_Model_User();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array());
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
		$this->view->role = $this->_auth->role;
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
				$model = new Admin_Model_User();
				$data = $model->find($id);
				if (empty($data)) {
					$this->_helper->redirector('index');
				} else {
					$form = new Admin_Form_User($this->_auth->role, $data);
					if ($this->getRequest()->isPost()) {
						$post = $this->getRequest()->getPost();
						if ($form->isValid($post)) {
							unset($post['submit']);
							foreach ($post AS $key => $value) {
								if ($key == 'password') {
									if (strlen($value) !== 0) {
										$data['password'] = sha1($data['password']);
									}
								} else {
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
				$model = new Admin_Model_User();
				$result = $model->delete($id);
				$this->_helper->redirector('index');
			}
		}
	}
	
	public function addAction()
	{
		$form = new Admin_Form_User($this->_auth->role);
		$model = new Admin_Model_User();
		if ($this->getRequest()->isPost()) {
			$post = $this->getRequest()->getPost();
			if ($form->isValid($post)) {
				
				unset($post['submit']);
				$data = array();
				foreach ($post AS $key => $value) {
					$data[$key] = $value;
				}
				$data['password'] = sha1($data['password']);
				$model->save($data);
			} else {
				$this->populate($post);
			}
		}
		$this->view->form = $form;
	}
}