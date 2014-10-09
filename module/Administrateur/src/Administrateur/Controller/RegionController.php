<?php

namespace Administrateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Utilisateur\Form\Personnage\newForm;
use Zend\View\Model\ViewModel;

class RegionController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = true;
    const activeFullLayout = true;

    public function indexAction() {
        return $this->redirect()->toRoute("home_admin/common", array("controller" => "region", "action" => "list"));
    }

    public function listAction() {
        
    }

    public function detailAction() {
        
    }

    public function addAction() {
        
    }

}
