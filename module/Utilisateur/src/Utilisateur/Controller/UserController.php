<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = false;
    const activeFullLayout = true;

    public function indexAction() {
        return new ViewModel();
    }

    public function profilAction() {
        $User = $this->getCurrentUser();
        return new ViewModel(array("User" => $User));
    }

}
