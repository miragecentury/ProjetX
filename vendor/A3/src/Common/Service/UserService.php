<?php

namespace A3\Common\Service;

use A3\Common\Entity\User;
use Utilisateur\Form\InscriptionForm;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class UserService implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function createUser(InscriptionForm $inscriptionForm) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $User = new User();
        $User
                ->setUsername($inscriptionForm->get("username")->getValue())
                ->setNom($inscriptionForm->get("nom")->getValue())
                ->setPrenom($inscriptionForm->get("prenom")->getValue())
                ->setEmail($inscriptionForm->get("email")->getValue())
                ->setDatecrea(new \DateTime("now"))
                ->setDatenai(\DateTime::createFromFormat("d/m/Y",$inscriptionForm->get("datenai")->getValue()))
                ->setSalt($this->generateSalt(32))
        ;
        $User->setHash(base64_encode(\mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($User->getSalt()), $inscriptionForm->get("passwd0")->getValue(), MCRYPT_MODE_CBC, md5(md5($User->getSalt())))));
        try {
            $em->persist($User);
            $em->flush();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    private function generateSalt($nb) {
        return mcrypt_create_iv($nb, MCRYPT_DEV_URANDOM);
    }

}
