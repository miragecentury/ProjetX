<?php

namespace A3\Common\Service;

use A3\Common\Entity\User;
use DateTime;
use Exception;
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
                ->setDatecrea(new DateTime("now"))
                ->setDatenai(DateTime::createFromFormat("d/m/Y", $inscriptionForm->get("datenai")->getValue()))
                ->setSalt($this->generateSalt(32))
                ->setEmailvalidatetoken($this->generateToken());
        ;
        $User->setHash(base64_encode(\mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($User->getSalt()), $inscriptionForm->get("passwd0")->getValue(), MCRYPT_MODE_CBC, md5(md5($User->getSalt())))));
        try {
            $em->persist($User);
            $em->flush();
        } catch (Exception $e) {
            return false;
        }
        return $User;
    }

    private function generateSalt($nb) {
        return \mcrypt_create_iv($nb, MCRYPT_DEV_URANDOM);
    }

    private function generateToken() {
        return \md5(\uniqid(\rand(), true));
    }

    /**
     * 
     * @param string $token
     */
    public function activateUserEmail($token) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
        $User = $userMapper->findOneByToken($token);
        if (is_a($User, "A3\Common\Entity\User")) {
            if (!$User->getEmailvalidate()) {
                $User->setEmailvalidatetoken(null);
                $User->setEmailvalidate(true);
                $em->persist($User);
                $em->flush($User);
                return true;
            } else {
                return null;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $email
     * @param type $password
     * @param type $mode
     * @return type
     */
    public function getToken($email, $password, $mode = 0) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
        $User = $userMapper->findOneByEmail($email);
        if (is_a($User, "A3\Common\Entity\User")) {
            if (base64_encode(\mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($User->getSalt()), $password, MCRYPT_MODE_CBC, md5(md5($User->getSalt())))) == $User->getHash()) {
                if ($mode == 2) {
                    $User->setTokenApiLauncher($this->generateToken());
                    $em->persist($User);
                    $em->flush();
                    return $User->getTokenApiLauncher();
                }
                if ($mode == 1) {
                    $User->setTokenApiWS($this->generateToken());
                    $em->persist($User);
                    $em->flush();
                    return $User->getTokenApiWS();
                }
                if ($mode == 0) {
                    $User->setTokenApiHttp($this->generateToken());
                    $em->persist($User);
                    $em->flush();
                    return $User->getTokenApiHttp();
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

}
