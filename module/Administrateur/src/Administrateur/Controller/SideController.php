<?php

namespace Administrateur\Controller;

use Administrateur\Form\Side\Add;
use BPC\Mvc\Controller\AbstractActionController;
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
        $sideMapper = $this->getServiceLocator()->get("A3/Common/Mapper/Side");
        $Sides = $sideMapper->findAll();
        return new ViewModel(array("Sides" => $Sides));
    }

    public function addAction() {
        $addSide = new Add();
        if ($this->getRequest()->isPOST()) {
            $addSide->setData($this->getRequest()->getPOST());
            if ($addSide->isValid()) {
                $SideService = $this->getServiceLocator()->get("A3/Common/Service/Side");
                $Side = $SideService->addSide($addSide);
                if (is_a($Side, "A3\Common\Entity\Side")) {
                    return $this->redirect()->toRoute("home_admin/home_admin_side_detail", array("controller" => "side", "action" => "detail", "idside" => $Side->getId()));
                } else {
                    return $this->addView($addSide, null, "Impossible de créer la Side. Vérifier l'unicité du label ou contacter un technicien.");
                }
            } else {
                return $this->addView($addSide, "Vérifier le format des données.");
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

    public function detailAction() {
        $idside = $this->params("idside", null);
        if ($idside == null) {
            return $this->redirect()->toRoute("home_admin/common", array("controller" => "side", "action" => "list"));
        }
        $sideMapper = $this->getServiceLocator()->get("A3\Common\Mapper\Side");
        $Side = $sideMapper->findOneById($idside);
        if (is_a($Side, "A3\Common\Entity\Side")) {
            return new ViewModel(array("Side" => $Side));
        } else {
            return $this->redirect()->toRoute("home_admin/common", array('controller' => "side", 'action' => "list"));
        }
    }

    public function delAction() {
        return new ViewModel();
    }

}
