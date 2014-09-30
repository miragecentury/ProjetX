<?php

namespace A3\Common\Service;

use A3\Common\Entity\User;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class PersonnageService implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function getActivePersonnage(User $User) {
        $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\Personnage");
        return $userMapper->findActiveByUser($User);
    }

}
