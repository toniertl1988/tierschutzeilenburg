<?php
class Application_Plugin_Auth_Acl extends Zend_Acl
{
    protected static $_instances;

    public static function getInstance()
    {
        if (null === self::$_instances) {
            self::$_instances = new Application_Plugin_Auth_Acl();
        }
        return self::$_instances;
    }

    protected function __construct()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/acl.ini');

        foreach ($config->roles as $role) {
            $this->addRole(new Zend_Acl_Role($role));
        }

        foreach ($config->ressources as $resource) {
            $this->add(new Zend_Acl_Resource($resource));
        }

        foreach ($config->rules as $function => $rule) {
            foreach ($rule as $role=>$resource) {
                foreach ($resource as $module=>$controllers) {
                    foreach ($controllers as $controller=>$action) {
                        $ressource = $module . '.' . $controller;
                        if ('all' == $action) {
                            $this->$function($role, $ressource);
                        } else {
                            $this->$function($role, $ressource, $action->toArray());
                        }
                    }
                }
            }
        }
	}
}