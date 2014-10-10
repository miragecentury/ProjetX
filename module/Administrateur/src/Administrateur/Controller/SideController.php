<?php

namespace Administrateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Utilisateur\Form\Personnage\newForm;
use Zend\View\Model\ViewModel;

class SideController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = true;
    const activeFullLayout = true;

    public function indexAction() {
        $this->redirect()->toRoute("home_admin/common", array("controller" => "side", "action" => "list"));
    }

    public function listAction() {
        
    }

    public function addAction() {
        
    }

}
