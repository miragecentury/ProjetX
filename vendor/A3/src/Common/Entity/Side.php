<?php

namespace A3\Common\Entity;

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

    /** @ORM\Column(type="boolean") */
    protected $recruting = false;

    /** @ORM\Column(type="boolean") */
    protected $active = false;

    /** @ORM\Column(type="boolean") */
    protected $reactiveNeedAuth = true;

    /** @ORM\Column(type="boolean") */
    protected $canCreateOrganisation = false;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="A3\Region\Entity\Island",mappedBy="MasterSide")
     */
    protected $MasterSideIslands;

    /**
     * @ORM\OneToMany(targetEntity="A3\Region\Entity\Island",mappedBy="LocalSide")
     */
    protected $LocalSideIslands;

    /**
     * @ORM\OneToMany(targetEntity="A3\Region\Entity\Island",mappedBy="InsurgencySide")
     */
    protected $InsurgencySideIslands;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\Grade",mappedBy="Side")
     */
    protected $Grades;
    
    /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\User",mappedBy="Side")
     */
    protected $Users;
    
     /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\Personnage",mappedBy="Side")
     */
    protected $Personnages;

}
