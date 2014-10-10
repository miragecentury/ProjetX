<?php

namespace A3\Common\Mapper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SideMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function findOneById($idSide) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\Side");
        $side = $repository->findOneBy(array("id" => $idSide));
        return $side;
    }

    public function findOneByLabel($label) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\Side");
        $side = $repository->findOneBy(array("label" => $label));
        return $side;
    }

    public function findAll() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\Side");
        return $repository->findAll();
    }

}
