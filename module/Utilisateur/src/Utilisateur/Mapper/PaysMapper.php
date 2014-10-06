<?php

namespace Utilisateur\Mapper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class PaysMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function findAll() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("Utilisateur\Entity\Pays");
        return $repository->findAll();
    }

}
