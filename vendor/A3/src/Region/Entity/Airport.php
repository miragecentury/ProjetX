<?php

namespace A3\Region\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Airport {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $label;

    /** @ORM\Column(type="float") */
    protected $x;

    /** @ORM\Column(type="float") */
    protected $y;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island", inversedBy="Airports")
     */
    protected $Island;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $isOnlyLocal = false;

    /** @ORM\Column(type="boolean") */
    protected $isOpenOut = false;

    /** @ORM\Column(type="boolean") */
    protected $isOpenIn = false;

    /**     * */
    /**     * */
}
