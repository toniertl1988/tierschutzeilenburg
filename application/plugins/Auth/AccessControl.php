<?php
class Application_Plugin_Auth_AccessControl extends Zend_Controller_Plugin_Abstract 
{
	public function __construct()
	{
		$this->_auth = Zend_Auth::getInstance();
		$this->_acl  = Application_Plugin_Auth_Acl::getInstance();
	}

	public function routeStartup(Zend_Controller_Request_Abstract $request)
	{
		if (!$this->_auth->hasIdentity() && null !== $request->getPost('login_user') && null !== $request->getPost('login_password')) {
			// POST-Daten bereinigen
			$filter = new Zend_Filter_StripTags();
			$username = $filter->filter($request->getPost('login_user'));
			$password = $filter->filter($request->getPost('login_password'));
            $view = Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer')->view;
			if (empty($username)) {
				$message = 'Bitte Benutzernamen angeben.';
			} 
			elseif (empty($password)) {
				$message = 'Bitte Passwort angeben.';
			} 
			else {
				$authAdapter = new Application_Plugin_Auth_AuthAdapter();
				$authAdapter->setIdentity($username);
				$authAdapter->setCredential($password);
				$result = $this->_auth->authenticate($authAdapter);
				if (!$result->isValid()) {
					$messages = $result->getMessages();
					$message = 'Der User konnte nicht gefunden werden!';
				} else {
					$storage = $this->_auth->getStorage();
					// die gesamte Tabellenzeile in der Session speichern,
					// wobei das Passwort unterdrueckt wird
					$storage->write($authAdapter->getResultRowObject(null, 'password'));
					// Last Login loggen
					//System_Model_User::logLastLogin($authAdapter->getResultRowObject(null, 'password'));
				}
			}

			if (isset($message)) {
				$view->message = $message;
			}
		}
	}

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{ 
		if ($this->_auth->hasIdentity() && is_object($this->_auth->getIdentity())) {
			$role = $this->_auth->getIdentity()->role;
		} else {
			$role = 'guest';
		}
		$module     = $request->getModuleName();
		$controller = $request->getControllerName();
		$action     = $request->getActionName();
		$resource   = $module . '.' . $controller;
		if (!$this->_acl->has($resource)) {
			$resource = null;
		}
		if (!$this->_acl->isAllowed($role, $resource, $action)) {
			// keine Rechte zum Anschauen
			$request->setModuleName('system');
			$request->setControllerName('auth');
			$request->setActionName('denied');
		}
	}
}
