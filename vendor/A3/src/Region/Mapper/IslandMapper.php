<?php

namespace A3\Region\Mapper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class IslandMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function findAllActive() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("active" => true));
        return $islands;
    }

    public function findAllNotActive() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("active" => false));
        return $islands;
    }

    public function findAllActivePublic() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("active" => true, "public" => true));
        return $islands;
    }

    public function findAllActiveNotPublic() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("active" => true, "public" => false));
        return $islands;
    }

    public function findOneByA3Serverport($a3port) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("a3serveurport" => $a3port));
        return $islands;
    }

    public function findOneByLabel($label) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Region\Entity\Island");
        $islands = $repository->findBy(array("label" => $label));
        return $islands;
    }

}
