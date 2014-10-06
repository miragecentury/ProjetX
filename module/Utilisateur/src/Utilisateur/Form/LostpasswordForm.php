<?php

namespace Utilisateur\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Between;
use Zend\Form\Element\Csrf;
use Zend\Validator\NotEmpty;

class LostpasswordForm extends \Zend\Form\Form {

    public function __construct() {
        parent::__construct("LostpasswordForm");
    }

}
