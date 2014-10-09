<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Utilisateur\Form\Personnage\newForm;
use Zend\View\Model\ViewModel;

class RegionController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = false;
    const activeFullLayout = true;

    public function indexAction() {
        if ($this->getCurrentUser()->getIsAdmin()) {
            return $this->redirect()->toRoute("home_admin", array("controller" => "region", "action" => "list"));
        } else {
            return $this->redirect()->toRoute("home_connected", array("controller" => "region", "action" => "list"));
        }
    }

    public function listAction() {
        $RegionMapper;
        $Regions;
    }

    public function detailAction() {
        $idRegion = $this->params("idregion", null);
        if ($idRegion != null) {
            
        } else {
            return $this->redirect()->toRoute("home_connected", array("controller" => "region", "action" => "list"));
        }
    }

}
