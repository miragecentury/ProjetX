<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use BPC\Service\Gunof;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    const needAuth = true;
    const needAuthorizeDev = true;
    const activeFullLayout = true;

    public function indexAction() {
        return new ViewModel();
    }

    public function firstconnectAction() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
        $User = $userMapper->findOneByEmail($this->getCurrentUser()->getEmail());
        if ($User->getFirstconnect()) {
            $User->setFirstconnect(false);
            $em->persist($User);
            $em->flush();
        }
        return new ViewModel(array("User" => $User));
    }

}
