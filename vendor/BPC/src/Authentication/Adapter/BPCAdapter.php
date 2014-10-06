<?php

namespace BPC\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class BPCAdapter implements AdapterInterface, ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    private $email = null;
    private $password = null;

    public function setData($array){
        if(isset($array["password"])){
            $this->setPassword($array["password"]);
        }
        if(isset($array["email"])){
            $this->setEmail($array["email"]);
        }
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     */
    public function authenticate() {
        if ($this->email == null || $this->password == null) {
            return new Result(Result::FAILURE);
        }
        $UserMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
        $UserMapper->setServiceLocator($this->getServiceLocator());
        $User = $UserMapper->getOneUserByEmail($this->email);
        if ($User != null) {
            if (base64_encode(\mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($User->getSalt()), $this->password, MCRYPT_MODE_CBC, md5(md5($User->getSalt())))) == $User->getHash()) {
                return new Result(Result::SUCCESS, $User);
            } else {
                return new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
            }
        } else {
            return new result(Result::FAILURE_IDENTITY_NOT_FOUND, null);
        }
    }

}
