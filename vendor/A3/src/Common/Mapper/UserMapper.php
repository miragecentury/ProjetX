<?php

namespace A3\Common\Mapper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class UserMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function findOneByEmail($email) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("email" => $email));
        return $user;
    }

    public function findOneById($id) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("id" => $id));
        return $user;
    }

    public function findOneByUsername($username) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("username" => $username));
        return $user;
    }

    public function findAll() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        return $repository->findAll();
    }

}
