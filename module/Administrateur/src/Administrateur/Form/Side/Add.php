<?php

namespace Administrateur\Form\Side;

use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\I18n\Validator\Alpha;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class Add extends Form {

    public function __construct() {
        parent::__construct("addSide");
        $shortLabel = new Text("shortlabel");
        $label = new Text("label");
        /**/
        $this->add($shortLabel);
        $this->add($label);
        /**/
        $inputFilter = $this->getInputFilter();
        $inputFilter->add(array(
            'name' => 'shortlabel',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                new Alpha(false),
                new StringLength(array('min' => 2,'max'=>15)),
                new NotEmpty(),
            )
        ));
        $inputFilter->add(array(
            'name' => 'label',
            'require' => true,
            'filters' => array(),
            'validators' => array(
                new Alpha(true),
                new StringLength(array('min' => 6,'max'=>50)),
                new NotEmpty()
            )
        ));
        /**/
    }

}
