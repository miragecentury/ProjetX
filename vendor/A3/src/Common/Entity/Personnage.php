<?php

namespace A3\Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Personnage {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $nom;

    /** @ORM\Column(type="string") */
    protected $prenom;

    /** @ORM\Column(type="string") */
    protected $username;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $active;
        /** @ORM\Column(type="boolean") */
    protected $connected;

    /**     * */

    /** @ORM\Column(type="datetime") */
    protected $datearri;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island")
     */
    protected $arrivedIsland;

    /** @ORM\Column(type="boolean") */
    protected $dead;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $datedead;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island")
     */
    protected $deadIsland;

    /**     * */

    /** @ORM\Column(type="string",nullable=true) */
    protected $spawnLocation;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island", inversedBy="Personnages")
     */
    protected $Island;

    /**     * */

    /** @ORM\Column(type="integer") */
    protected $food;

    /** @ORM\Column(type="integer") */
    protected $water;

    /**     * */

    /** @ORM\Column(type="integer") */
    protected $blood;

    /** @ORM\Column(type="integer") */
    protected $morphin;

    /** @ORM\Column(type="integer") */
    protected $adrena;

    /** @ORM\Column(type="string") */
    protected $partBleeding;

    /** @ORM\Column(type="string") */
    protected $partPain;

    /** @ORM\Column(type="string") */
    protected $partIntegrity;

    /**     * */

    /** @ORM\Column(type="text") */
    protected $weapon;

    /** @ORM\Column(type="text") */
    protected $pistol;

    /** @ORM\Column(type="text") */
    protected $item;

    /** @ORM\Column(type="text") */
    protected $uniform;

    /** @ORM\Column(type="text") */
    protected $vest;

    /** @ORM\Column(type="text") */
    protected $backpack;

    /**     * */
    protected $isActive = true;
    protected $waitReactive;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $TTLforChangeActive;

    /**     * */

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\Side", inversedBy="Personnages")
     */
    protected $Side;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\Grade", inversedBy="Personnages")
     */
    protected $Grade;
    /**     * */

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\User", inversedBy="Personnages")
     */
    protected $User;

}
