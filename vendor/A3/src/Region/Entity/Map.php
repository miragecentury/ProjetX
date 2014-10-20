<?php

namespace A3\Region\Entity;

use BPC\BasicEnum;

class Map extends BasicEnum {

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
