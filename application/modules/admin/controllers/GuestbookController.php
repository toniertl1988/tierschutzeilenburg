<?php
class Admin_GuestbookController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new Admin_Model_Guestbook();
		$paginator = Zend_Paginator::factory($model->fetchAll2Array('date', 'DESC'));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
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
				$model = new Admin_Model_Guestbook();
				$result = $model->delete($id);
				$this->_helper->redirector('index');
			}
		}
	}
	
	public function answerAction()
	{
		if (!$this->_hasParam('id')) {
			$this->_helper->redirector('index');
		} else {
			$id = intval($this->_getParam('id'));
			if ($id === 0) {
				$this->_helper->redirector('index');
			} else {
				$form = new Admin_Form_Guestbook();
				$model = new Admin_Model_Guestbook();
				if ($this->getRequest()->isPost()) {
					$post = $this->getRequest()->getPost();
					if ($form->isValid($post)) {
						unset($post['submit']);
						$data = array();
						// eingeloggten User als Poster hinzufuegen
						$auth = Zend_Auth::getInstance();
						$data['creator'] = $auth->getIdentity()->realname;
						$data['answerTo'] = $id;
						$data['date'] = new Zend_Db_Expr('NOW()');
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