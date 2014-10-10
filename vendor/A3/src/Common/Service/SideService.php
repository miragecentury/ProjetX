<?php

namespace A3\Common\Service;

use A3\Common\Entity\Side;
use Administrateur\Form\Side\Add;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SideService implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function addSide(Add $addSideForm) {
        //vérifier l'unicité du label
        $sideMapper = $this->getServiceLocator()->get("A3\Common\Mapper\Side");
        $Side = $sideMapper->findOneByLabel($addSideForm->get("shortlabel")->getValue());
        if (is_a($Side, "A3\Common\Entity\Side") == false) {
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            //prépaper l'objet
            $Side = new Side();
            $Side
                    ->setLabel($addSideForm->get("shortlabel")->getValue())
                    ->setLonglabel($addSideForm->get("label")->getValue())
            ;
            //persisté
            try {
                $em->persist($Side);
                $em->flush();
            } catch (Exception $ex) {
                return false;
            }
            return $Side;
        } else {
            return false;
        }
    }

}
