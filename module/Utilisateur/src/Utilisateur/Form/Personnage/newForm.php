<?php

namespace Utilisateur\Form\Personnage;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Date;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Validator\NotEmpty;

class newForm extends Form {

    public function __construct() {
        parent::__construct("newForm");
        /**/
        
        
    }

}
