<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use Utilisateur\Form\Personnage\newForm;
use Zend\View\Model\ViewModel;

class PersonnageController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = false;
    const activeFullLayout = true;

    public function indexAction() {
        $personnageService = $this->getServiceLocator()->get("A3\Common\Service\Personnage");
        $Personnage = $personnageService->getActivePersonnage($this->getCurrentUser());
        if (!is_a($Personnage, "A3\Common\Entity\Personnage")) {
            return $this->redirect()->toRoute("home_connected/common", array("controller" => "personnage", "action" => "new"));
        }
        return new ViewModel();
    }

    public function newAction() {
        $newPersonneForm = new newForm();
        if ($this->getRequest()->isPOST()) {
            
        } else {
            return new ViewModel();
        }
    }

    public function listAction() {
        return new ViewModel();
    }

}
