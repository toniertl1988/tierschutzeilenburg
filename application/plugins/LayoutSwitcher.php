<?php
class Application_Plugin_LayoutSwitcher extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        if ('admin' != $request->getModuleName()) {
            // If not in this module, return early
            return;
        }

        // Change layout
        Zend_Layout::getMvcInstance()->setLayout('admin');
    }
}