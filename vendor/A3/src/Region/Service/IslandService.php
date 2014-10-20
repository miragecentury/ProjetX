<?php

namespace A3\Region\Service;

use A3\Region\Entity\Island;
use Administrateur\Form\Island\Add;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class IslandService implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    public function addIsland(Add $addIslandForm) {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $islandMapper = $this->getServiceLocator()->get("A3\Region\Mapper\Island");
        $sideMapper = $this->getServiceLocator()->get("A3\Common\Mapper\Side");
        //Check Unique Label
        $Island = $islandMapper->findOneByLabel($addIslandForm->get("nom")->getValue());
        if (!is_a($Island, "A3\Region\Entity\Island")) {
            //Check Unique Port
            $Island = $islandMapper->findOneByA3Serverport($addIslandForm->get("a3port")->getValue());
            if (!is_a($Island, "A3\Region\Entity\Island")) {
                $Island = new Island();
                $Island
                        ->setLabel($addIslandForm->get("nom")->getValue())
                        ->setA3serveurport($addIslandForm->get("a3port")->getValue())
                        ->setActive(false)
                        ->setPublic(false)
                ;

                if ($addIslandForm->get("sideRegu")->getValue() != -1) {
                    $Island->setMasterSide($MasterSide->findOneById($addIslandForm->get("sideRegu")->getValue()));
                }

                if ($addIslandForm->get("sidePolice")->getValue() != -1) {
                    $Island->setLocalSide($LocalSide->findOneById($addIslandForm->get("sidePolice")->getValue()));
                }

                if ($addIslandForm->get("sideInsu0")->getValue() != -1) {
                    $Island->setInsurgency0Side($Insurgency0Side->findOneById($addIslandForm->get("sideInsu0")->getValue()));
                }

                if ($addIslandForm->get("sideInsu1")->getValue() != -1) {
                    $Island->setInsurgency1Side($Insurgency1Side->findOneById($addIslandForm->get("sideInsu1")->getValue()));
                }
                try {
                    $em->persist($Island);
                    $em->flush();
                } catch (Exception $e) {
                    return false;
                }
                return $Island;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
