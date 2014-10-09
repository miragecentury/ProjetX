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
    protected $InsurgencySide;

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
}

class Island_Map extends BasicEnum {

    const Altis = 0;
    const Stratis = 1;
    const Reshmann = 2;

    public static function convertToString($const) {
        switch ($const) {
            case self::Altis:
                return "Altis";
            case self::Stratis:
                return "Stratis";
            case self::Reshmann:
                return "Reshmann";
            default:
                return null;
                break;
        }
    }

    public static function getInfos($const) {
        switch ($const) {
            case self::Altis:
                return array(
                    "sizeX" => 0,
                    "sizeY" => 0,
                    "safeTolerance" => 0,
                    "nbAirport" => 5,
                    "coordAirport" => array(
                        array(0, 0), //Airport Central
                        array(0, 0), //Airport du Nord-Ouest
                        array(0, 0), //Airport du Nord-Est
                        array(0, 0), //Airport du Sud-Est
                        array(0, 0), //Airport du Sud-Ouest
                    ),
                    "islocalAirport" => array(
                        false,
                        true,
                        true,
                        true,
                        true,
                    ),
                );
            case self::Stratis:
                return array(
                    "sizeX" => 0,
                    "sizeY" => 0,
                    "safeTolerance" => 0,
                    "nbAirport" => 0,
                    "coordAirport" => array(),
                );
            case self::Reshmann:
                return array(
                    "sizeX" => 0,
                    "sizeY" => 0,
                    "safeTolerance" => 0,
                    "nbAirport" => 0,
                    "coordAirport" => array(),
                );
            default:
                return null;
                break;
        }
    }

}
