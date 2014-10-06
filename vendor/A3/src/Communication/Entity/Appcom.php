<?php

namespace A3\Communication\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Appcom {

    const TYPE_PORTABLE_CL_01 = "PORT01";
    const TYPE_PORTABLE_CL_02 = "PORT02";
    const TYPE_PORTABLE_CL_03 = "PORT03";
    const TYPE_PORTABLE_CL_04 = "PORT04";
    const TYPE_FIXE = "FIX";
    const TYPE_SATELLITE = "SAT";
    const TYPE_BIPPER = "BIP";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $numero;

    /** @ORM\Column(type="string") */
    protected $type;

}
