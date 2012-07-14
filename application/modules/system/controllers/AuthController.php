<?php
class AuthController extends Zend_Controller_Action
{
	protected $_auth;

	public function init()
	{
		$this->_auth = Zend_Auth::getInstance();
	}

	public function deniedAction()
	{
		
	}
	
	public function loginAction()
	{
		$auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_helper->_redirector('index', 'index');
        }
        $form = new Zend_Form();
        $form->setAction('')->setMethod('post');
		$form->setOptions(array('class' => 'well'));
        $user = new Zend_Form_Element_Text('login_user', array('label' => 'Benutzername', 'required' => true));
        $password = new Zend_Form_Element_Password('login_password', array('label' => 'Passwort', 'required' => true));
        $submit = new Zend_Form_Element_Submit('submit', array('label' => 'Anmelden'));
        $form->addElements(array($user, $password, $submit));
        $this->view->form = $form;
	}
	
	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index', 'index', 'system');
	}
}