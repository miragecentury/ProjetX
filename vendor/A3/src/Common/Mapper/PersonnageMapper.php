<?php

namespace A3\Common\Mapper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class PersonnageMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    function findOneById($id) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\Personnage");
        $personnage = $repository->findOneBy(array("id" => $id));
        return $personnage;
    }

    function findActiveByUser($User) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\Personnage");
        $personnage = $repository->findOneBy(array("active" => true, "User" => $User));
        return $personnage;
    }

}
