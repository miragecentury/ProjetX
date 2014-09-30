<?php

namespace Moderateur;

use Traversable;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Session\Container;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface {

    public function onBootstrap(MvcEvent $e) {
        
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|Traversable
     */
    public function getConfig() {
        return require __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
