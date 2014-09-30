<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NotificationController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = false;
    const activeFullLayout = true;

    public function indexAction() {
        return new ViewModel();
    }

}
