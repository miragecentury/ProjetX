<?php

namespace A3\Common\Entity;

use A3\Region\Entity\Island;
use BPC\BasicEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Side {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $label;

    /** @ORM\Column(type="string") */
    protected $longlabel;

    /** @ORM\Column(type="integer") */
    protected $recruting = 0;

    /** @ORM\Column(type="integer") */
    protected $typeorganisation = 0;

    /** @ORM\Column(type="boolean") */
    protected $active = false;

    /** @ORM\Column(type="integer") */
    protected $reactiveNeedAuth = true;

    /** @ORM\Column(type="boolean") */
    protected $canCreateOrganisation = false;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="\A3\Region\Entity\Island",mappedBy="MasterSide")
     */
    protected $MasterSideIslands;

    /**
     * @ORM\OneToMany(targetEntity="\A3\Region\Entity\Island",mappedBy="LocalSide")
     */
    protected $LocalSideIslands;

    /**
     * @ORM\OneToMany(targetEntity="\A3\Region\Entity\Island",mappedBy="Insurgency0Side")
     */
    protected $Insurgency0SideIslands;

    /**
     * @ORM\OneToMany(targetEntity="\A3\Region\Entity\Island",mappedBy="Insurgency1Side")
     */
    protected $Insurgency1SideIslands;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="Grade",mappedBy="Side")
     */
    protected $Grades;

    /**
     * @ORM\OneToMany(targetEntity="User",mappedBy="Side")
     */
    protected $Users;

    /**
     * @ORM\OneToMany(targetEntity="Personnage",mappedBy="Side")
     */
    protected $Personnages;

    /*     * **************************************************************** */

    function getId() {
        return $this->id;
    }

    function getLabel() {
        return $this->label;
    }

    function getLonglabel() {
        return $this->longlabel;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    function setLonglabel($longlabel) {
        $this->longlabel = $longlabel;
        return $this;
    }

    function getRecruting() {
        return $this->recruting;
    }

    function getActive() {
        return $this->active;
    }

    function setRecruting($recruting) {
        $this->recruting = $recruting;
        return $this;
    }

    function setActive($active) {
        $this->active = $active;
        return $this;
    }

    function getReactiveNeedAuth() {
        return $this->reactiveNeedAuth;
    }

    function setReactiveNeedAuth($reactiveNeedAuth) {
        $this->reactiveNeedAuth = $reactiveNeedAuth;
        return $this;
    }

    function getTypeorganisation() {
        return $this->typeorganisation;
    }

    function setTypeorganisation($typeorganisation) {
        $this->typeorganisation = $typeorganisation;
        return $this;
    }

}
