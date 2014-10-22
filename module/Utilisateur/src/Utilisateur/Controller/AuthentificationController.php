<?php

namespace Utilisateur\Controller;

use BPC\Wamp\Topic\Common\User\Event\LoginEvent;
use DateTime;
use Utilisateur\Form\InscriptionForm;
use Utilisateur\Form\LoginForm;
use Utilisateur\Form\LostpasswordForm;
use Utilisateur\Mail\ValidationMail;
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
                    $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
                    $User = $userMapper->findOneByEmail($this->identity()->getEmail());
                    if ($User->getEmailvalidate()) {
                        $dateTime = new DateTime("now");
                        $loginEvent = new LoginEvent($User->getId(), $User->getEmail(), $User->getUsername(), time());
                        $loginEvent->sendInternalEvent();
                        if (!$User->getFirstconnect()) {
                            return $this->redirect()->toRoute("home_connected");
                        } else {
                            return $this->redirect()->toRoute("home_connected", array("controller" => "index", "action" => "firstconnect"));
                        }
                    } else {
                        return $this->loginView($loginForm, null, "Merci de valider votre adresse email.<br/> Vérifier votre boîte email et cliquer sur le lien d'activation.");
                    }
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
                $UserMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
                $email = $inscriptionForm->get("email")->getValue();
                $username = $inscriptionForm->get("username")->getValue();
                //Vérification de l'unicité de l'email
                $User = $UserMapper->findOneByEmail($email);
                if (!(is_a($User, "A3\Common\Entity\User"))) {
                    //Vérification de l'unicité de l'username
                    $User = $UserMapper->findOneByUsername($username);
                    if (!(is_a($User, "A3\Common\Entity\User"))) {
                        //Vérification du mot de passe et de control
                        if ($inscriptionForm->get("passwd0")->getValue() == $inscriptionForm->get("passwd1")->getValue()) {
                            $UserService = $this->getServiceLocator()->get("A3\Common\Service\User");
                            if (is_a(($User = $UserService->createUser($inscriptionForm)), "A3\Common\Entity\User")) {
                                $emailvalidattion = new ValidationMail($User);
                                $emailvalidattion->setServiceLocator($this->getServiceLocator());
                                if ($emailvalidattion->sendme()) {
                                    return $this->endinscriptionView();
                                } else {
                                    return $this->inscriptionView($inscriptionForm, "Problème lors de l'envoi de l'email. Veuillez contacter un administrateur.");
                                }
                            } else {
                                return $this->inscriptionView($inscriptionForm, "Problème lors de la creation du compte. Veuillez contacter un administrateur.");
                            }
                        } else {
                            return $this->inscriptionView($inscriptionForm, null, "Les deux mot de passe ne sont pas identique.");
                        }
                    } else {
                        return $this->inscriptionView($inscriptionForm, null, "L'Username est déjà enregistré.");
                    }
                } else {
                    return $this->inscriptionView($inscriptionForm, null, "L'email est déjà enregistré.");
                }
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

    private function endinscriptionView() {
        $this->layout("layout/layout_login");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("utilisateur/authentification/endinscription");
        return $viewModel;
    }

    public function activateAction() {
        $token = $this->params("token", null);
        if ($token != null) {
            $userService = $this->getServiceLocator()->get("A3\Common\Service\User");
            if (($res = $userService->activateUserEmail($token)) == null) {
                return new ViewModel(array("error" => "Votre Compte est déjà validé."));
            } else {
                if ($res) {
                    return new ViewModel(array("success" => "Votre Compte est validé."));
                } else {
                    return new ViewModel(array("error" => "Impossible d'activé votre compte, contacter un administrateur sur le teamspeak."));
                }
            }
        } else {
            return $this->redirect()->toRoute("home_login");
        }

        $this->layout("layout/layout_login");
        return new ViewModel();
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

    public function noauthAction() {
        $this->layout("layout/layout_login");
        return new ViewModel();
    }

}
