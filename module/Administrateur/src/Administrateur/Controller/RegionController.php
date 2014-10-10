<?php

namespace Administrateur\Controller;

use Administrateur\Form\Region\Add;
use BPC\Mvc\Controller\AbstractActionController;
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
        $idregion = $this->params("idregion", null);
        if ($idregion == null) {
            return $this->redirect()->toRoute("home_admin/common", array("controller" => "region", "action" => "list"));
        }
        $regionMapper = $this->getServiceLocator()->get("A3/Region/Mapper/Region");
        $Region = $regionMapper->findOneById($idregion);
        if (is_a($Region, "A3/Region/Entity/Region")) {
            return new ViewModel(array("Region" => $Region));
        } else {
            return $this->redirect()->toRoute("home_admin/common", array("controller" => "region", "action" => "list"));
        }
    }

    public function addAction() {
        $addRegion = new Add();
        if ($this->getRequest()->isPOST()) {
            $addRegion->setData($this->getRequest()->getPOST());
            if ($addRegion->isValid()) {
                $regionService = $this->getServiceLocator()->get("A3/Region/Service/Region");
                $Region = $regionService->addRegion($addRegion);
                if (is_a($Region, "A3/Region/Entity/region")) {
                    return $this->redirect()->toRoute("home_admin/home_admin_side_detail", array("controller" => "region", "action" => "detail", "idregion" => $Region->getId()));
                } else {
                    return $this->addView($addRegion, null, "Impossible de créer la Région.");
                }
            } else {
                return $this->addView($addRegion, "Vérifier le format des données.");
            }
        } else {
            return $this->addView();
        }
    }

    private function addView(Add $form = null, $warnmessage = null, $errormessage = null) {
        if ($form == null) {
            $form = new Add();
        }
        return new ViewModel(array(
            'addSideForm' => $form,
            'warnmessage' => $warnmessage,
            'errormessage' => $errormessage,
        ));
    }

}
