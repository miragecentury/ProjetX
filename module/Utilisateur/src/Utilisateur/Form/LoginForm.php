<?php

namespace Utilisateur\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Between;
use Zend\Form\Element\Csrf;
use Zend\Validator\NotEmpty;

class LoginForm extends \Zend\Form\Form {

    public function __construct() {
        parent::__construct("LoginForm");
        /**/
        $email = new Email("email");
        $password = new Password("password");
        $csrf = new Csrf("token_csrf");
        /**/
        $this->add($email);
        $this->add($password);
        $this->add($csrf);
        /**/
        $inputFilter = $this->getInputFilter();
        $inputFilter->add($email->getInputSpecification());
        $inputFilter->add(array(
            'name' => 'password',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                //new Alnum(array('allowWhiteSpace' => true)),
                //new Between(array('min' => 6, 'max' => 10)),
                new NotEmpty()
            )
        ));
        $inputFilter->add($csrf->getInputSpecification());
    }

}
