<?php

namespace BPC\Authentication;

class AuthenticationServiceFactory implements \Zend\ServiceManager\FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $AuthenticationService = new \Zend\Authentication\AuthenticationService();
        return $AuthenticationService;
    }

    private function setupLayout() {
        $auth = $this->getServiceLocator()->get("Zend\Authentication\AuthenticationService");
        //$view_header = new ViewModel(array("identity" => $auth->getIdentity()));
        //$view_header->setTemplate("layout/header");
        //$view_sidebar = new ViewModel();
        //$view_sidebar->setTemplate("layout/sidebar");
        //$view_quicksidebar = new ViewModel();
        //$view_quicksidebar->setTemplate("layout/quicksidebar");
        //$this->layout()->addChild($view_header, "template_header");
        //$this->layout()->addChild($view_sidebar, "template_sidebar");
        //$this->layout()->addChild($view_quicksidebar, "template_quicksidebar");
    }

}
