<?php

namespace Utilisateur;

use Locale;
use Traversable;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;

class Module implements ConfigProviderInterface {

    public function onBootstrap(MvcEvent $e) {
        date_default_timezone_set('Europe/Paris');
        $serviceManager = $e->getApplication()->getServiceManager();
        $translator = $serviceManager->get('translator');

        //$locale = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $locale = 'fr_FR';
        //$locale = 'en_US';

        $translator->setLocale(Locale::acceptFromHttp($locale));
        $translator->addTranslationFile(
                'phpArray', __DIR__ . '/../../vendor/zendframework/zendframework/resources/languages/fr/Zend_Validate.php', 'default', 'fr_FR'
        );
        AbstractValidator::setDefaultTranslator($translator);
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
