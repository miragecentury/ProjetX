<?php

namespace A3\Common\Mapper;

use A3\Common\Entity\User;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class UserMapper implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    /**
     * 
     * @param type $email
     * @return User
     */
    public function findOneByEmail($email) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("email" => $email));
        return $user;
    }

    /**
     * 
     * @param type $id
     * @return User
     */
    public function findOneById($id) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("id" => $id));
        return $user;
    }

    /**
     * 
     * @param type $username
     * @return User
     */
    public function findOneByUsername($username) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("username" => $username));
        return $user;
    }

    /**
     * 
     * @param type $token
     * @return User
     */
    public function findOneByToken($token) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        $user = $repository->findOneBy(array("emailvalidatetoken" => $token));
        return $user;
    }

    /**
     * 
     * @return Array
     */
    public function findAll() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("A3\Common\Entity\User");
        return $repository->findAll();
    }

}
