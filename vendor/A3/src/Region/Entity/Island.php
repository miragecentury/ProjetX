<?php

namespace A3\Region\Entity;

use A3\Common\Entity\Personnage;
use A3\Common\Entity\Side;
use BPC\BasicEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Island {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $label;

    /** @ORM\Column(type="boolean") */
    protected $active;

    /** @ORM\Column(type="boolean") */
    protected $public;

    /**     * */

    /** @ORM\Column(type="float") */
    protected $sizeX;

    /** @ORM\Column(type="float") */
    protected $sizeY;

    /** @ORM\Column(type="float") */
    protected $safeTolerance;

    /** @ORM\Column(type="string") */
    protected $map;

    /**     * */

    /**
     * @ORM\ManyToOne(targetEntity="\A3\Common\Entity\Side", inversedBy="MasterSideIslands")
     */
    protected $MasterSide;

    /**
     * @ORM\ManyToOne(targetEntity="\A3\Common\Entity\Side", inversedBy="LocalSideIslands")
     */
    protected $LocalSide;

    /**
     * @ORM\ManyToOne(targetEntity="\A3\Common\Entity\Side", inversedBy="InsugencySideIslands")
     */
    protected $Insurgency0Side;

    /**
     * @ORM\ManyToOne(targetEntity="\A3\Common\Entity\Side", inversedBy="InsugencySideIslands")
     */
    protected $Insurgency1Side;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $isLockDown;

    /** @ORM\Column(type="boolean") */
    protected $isLockDownMilitary;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="Airport",mappedBy="Island")
     */
    protected $Airports;

    /**
     * @ORM\OneToMany(targetEntity="\A3\Common\Entity\Personnage",mappedBy="Island")
     */
    protected $Personnages;

    /**     * */

    /** @ORM\Column(type="string") */
    protected $pathToA3Dir;

    /** @ORM\Column(type="integer") */
    protected $a3serveurport;

    /**     * */
    function getId() {
        return $this->id;
    }

    function getLabel() {
        return $this->label;
    }

    function getActive() {
        return $this->active;
    }

    function getPublic() {
        return $this->public;
    }

    function getSizeX() {
        return $this->sizeX;
    }

    function getSizeY() {
        return $this->sizeY;
    }

    function getSafeTolerance() {
        return $this->safeTolerance;
    }

    function getMap() {
        return $this->map;
    }

    function getMasterSide() {
        return $this->MasterSide;
    }

    function getLocalSide() {
        return $this->LocalSide;
    }

    function getInsurgency0Side() {
        return $this->Insurgency0Side;
    }

    function getInsurgency1Side() {
        return $this->Insurgency1Side;
    }

    function getIsLockDown() {
        return $this->isLockDown;
    }

    function getIsLockDownMilitary() {
        return $this->isLockDownMilitary;
    }

    function getAirports() {
        return $this->Airports;
    }

    function getPersonnages() {
        return $this->Personnages;
    }

    function getPathToA3Dir() {
        return $this->pathToA3Dir;
    }

    function getA3serveurport() {
        return $this->a3serveurport;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    function setActive($active) {
        $this->active = $active;
        return $this;
    }

    function setPublic($public) {
        $this->public = $public;
        return $this;
    }

    function setSizeX($sizeX) {
        $this->sizeX = $sizeX;
        return $this;
    }

    function setSizeY($sizeY) {
        $this->sizeY = $sizeY;
        return $this;
    }

    function setSafeTolerance($safeTolerance) {
        $this->safeTolerance = $safeTolerance;
        return $this;
    }

    function setMap($map) {
        $this->map = $map;
        return $this;
    }

    function setMasterSide($MasterSide) {
        $this->MasterSide = $MasterSide;
        return $this;
    }

    function setLocalSide($LocalSide) {
        $this->LocalSide = $LocalSide;
        return $this;
    }

    function setInsurgency0Side($Insurgency0Side) {
        $this->Insurgency0Side = $Insurgency0Side;
        return $this;
    }

    function setInsurgency1Side($Insurgency1Side) {
        $this->Insurgency1Side = $Insurgency1Side;
        return $this;
    }

    function setIsLockDown($isLockDown) {
        $this->isLockDown = $isLockDown;
        return $this;
    }

    function setIsLockDownMilitary($isLockDownMilitary) {
        $this->isLockDownMilitary = $isLockDownMilitary;
        return $this;
    }

    function setAirports($Airports) {
        $this->Airports = $Airports;
        return $this;
    }

    function setPersonnages($Personnages) {
        $this->Personnages = $Personnages;
        return $this;
    }

    function setPathToA3Dir($pathToA3Dir) {
        $this->pathToA3Dir = $pathToA3Dir;
        return $this;
    }

    function setA3serveurport($a3serveurport) {
        $this->a3serveurport = $a3serveurport;
        return $this;
    }

}
