<?php
class Application_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
		$translator = new Zend_Translate(
        array(
            'adapter' => 'array',
            'content' => APPLICATION_PATH . '/languages',
            'locale'  => 'de',
            'scan' => Zend_Translate::LOCALE_DIRECTORY
        )
		);
		Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
}