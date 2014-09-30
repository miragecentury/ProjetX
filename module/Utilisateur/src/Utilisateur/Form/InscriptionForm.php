<?php

namespace Utilisateur\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Date;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Validator\NotEmpty;

class InscriptionForm extends Form {

    public function __construct() {
        parent::__construct("InscriptionForm");
        /**/
        $nom = new Text("nom");
        $prenom = new Text("prenom");
        $datenai = new Date("datenai");
        $pays = new Select("pays", array(
            "value_options" => array(
                
            )
        ));
        $adresse = new Text("adresse");
        $ville = new Text("ville");
        /**/
        $email = new Email("email");
        $username = new Text("username");
        $passwd0 = new Password("passwd0");
        $passwd1 = new Password("passwd1");
        $csrf = new Csrf("token_csrf");

        $datenai->setOptions(array(
            'format' => 'm/d/Y'
        ));
        /**/
        $this->add($nom);
        $this->add($prenom);
        $this->add($datenai);
        $this->add($pays);
        $this->add($adresse);
        $this->add($ville);
        /**/
        $this->add($username);
        $this->add($email);
        $this->add($passwd0);
        $this->add($passwd1);
        $this->add($csrf);
        /**/
        $inputFilter = $this->getInputFilter();
        $inputFilter->add($email->getInputSpecification());
        $inputFilter->add($datenai->getInputSpecification());
        $inputFilter->add($pays->getInputSpecification());
        $inputFilter->add(array(
            'name' => 'passwd0',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                //new Alnum(array('allowWhiteSpace' => true)),
                //new Between(array('min' => 6, 'max' => 10)),
                new NotEmpty()
            )
        ));
        $inputFilter->add(array(
            'name' => 'passwd1',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                //new Alnum(array('allowWhiteSpace' => true)),
                //new Between(array('min' => 6, 'max' => 10)),
                new NotEmpty()
            )
        ));
        $inputFilter->add(array(
            'name' => 'nom',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                //new Alnum(array('allowWhiteSpace' => true)),
                //new Between(array('min' => 6, 'max' => 10)),
                new NotEmpty()
            )
        ));
        $inputFilter->add(array(
            'name' => 'prenom',
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
