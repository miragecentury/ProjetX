<?php

namespace Administrateur\Form\Island;


use A3\Common\Mapper\SideMapper;
use A3\Region\Entity\Map;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Add extends Form {

    public function __construct(SideMapper $sideMapper) {
        parent::__construct("addRegion");
        $Sides = $sideMapper->findAll();
        $options = array();
        $options[-1] = "-- Aucun --";
        foreach ($Sides as $Side) {
            $options[$Side->getId()] = $Side->getLabel() . ' - ' . $Side->getLongLabel();
        }

        /**/
        $nom = new Text("nom");
        $a3port = new Text("a3port");
        $map = new Select("map");
        $map->setValueOptions(array(
            Map::Altis => Map::convertToString(Map::Altis),
            Map::Reshmann => Map::convertToString(Map::Reshmann),
            Map::Stratis => Map::convertToString(Map::Stratis),
        ));
        /**/
        $sideRegu = new Select("sideRegu");
        $sideRegu->setValueOptions($options);
        $sidePolice = new Select("sidePolice");
        $sidePolice->setValueOptions($options);
        $sideInsu0 = new Select("sideInsu0");
        $sideInsu0->setValueOptions($options);
        $sideInsu1 = new Select("sideInsu1");
        $sideInsu1->setValueOptions($options);
        /**/

        $this->add($nom);
        $this->add($a3port);
        $this->add($map);
        $this->add($sideRegu);
        $this->add($sidePolice);
        $this->add($sideInsu0);
        $this->add($sideInsu1);

        /**/
    }

}
