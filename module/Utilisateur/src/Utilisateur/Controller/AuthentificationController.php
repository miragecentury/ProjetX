<?php

namespace Utilisateur\Controller;

use Utilisateur\Form\InscriptionForm;
use Utilisateur\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthentificationController extends AbstractActionController {

    public function loginAction() {
        $loginForm = new LoginForm();
        if ($this->getRequest()->isPOST()) {
            $loginForm->setData($this->getRequest()->getPOST());
            if ($loginForm->isValid()) {
                $authentificationAdapter = $this->getServiceLocator()->get("BPC\Authentication\Adapter\BPCAdapter");
                $authentificationAdapter->setServiceLocator($this->getServiceLocator());
                $authentificationAdapter->setData($loginForm->getData());
                $auth = $this->getServiceLocator()->get("Zend\Authentication\AuthenticationService");
                $auth->setAdapter($authentificationAdapter);
                $auth->authenticate();
                if ($this->identity() != null) {
                    return $this->redirect()->toRoute("home_connected");
                } else {
                    return $this->loginView($loginForm, null, "Combinaison Email, Password incorrecte.");
                }
            } else {
                return $this->loginView($loginForm, null, "Un ou plusieurs champs sont incorrectes.");
            }
        } else {
            return $this->loginView($loginForm);
        }
    }

    private function loginView(LoginForm $loginForm, $messageErr = null, $messageWarn = null) {
        $viewModel = new ViewModel(array(
            "form_login" => new LoginForm(),
            "form_login_messageErr" => $messageErr,
            "form_login_messageWarn" => $messageWarn,
            "form_inscription" => new InscriptionForm($this->getServiceLocator()->get("Utilisateur\Mapper\Pays")),
        ));
        $this->layout("layout/layout_login");
        return $viewModel;
    }

    public function logoutAction() {
        $auth = $this->getServiceLocator()->get("Zend\Authentication\AuthenticationService");
        $auth->clearIdentity();
        return $this->redirect()->toRoute("home");
    }

    public function inscriptionAction() {
        $inscriptionForm = new InscriptionForm($this->getServiceLocator()->get("Utilisateur\Mapper\Pays"));
        if ($this->getRequest()->isPOST()) {
            $inscriptionForm->setData($this->getRequest()->getPOST());
            if ($inscriptionForm->isValid()) {
                $email = $inscriptionForm->get("email")->getValue();
                $username = $inscriptionForm->get("username")->getValue();
                
            } else {
                return $this->inscriptionView($inscriptionForm, null, "Vérifier le format des données que vous avez entré.");
            }
        } else {
            return $this->inscriptionView($inscriptionForm);
        }
    }

    private function inscriptionView(InscriptionForm $inscriptionForm, $messageErr = null, $messageWarn = null) {
        $viewModel = new ViewModel(array(
            "form_login" => new LoginForm(),
            "form_inscription" => $inscriptionForm,
            "form_inscription_messageErr" => $messageErr,
            "form_inscription_messageWarn" => $messageWarn,
        ));
        $this->layout("layout/layout_login");
        $viewModel->setTemplate("utilisateur/authentification/login");
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $renderer->inlineScript()->appendScript("
            jQuery(document).ready(function() {  
                jQuery('.login-form').hide();
                jQuery('.register-form').show();
            });
        ");
        return $viewModel;
    }

    public function passwordresetAction() {
        
    }

    public function passwordresetView(LostpasswordForm $lostpasswordForm, $messageErr = null, $messageWarn = null) {
        
    }

    public function confpolAction() {
        $this->layout("layout/layout_login");
        return new ViewModel();
    }

    public function condutilAction() {
        $this->layout("layout/layout_login");
        return new ViewModel();
    }

}
