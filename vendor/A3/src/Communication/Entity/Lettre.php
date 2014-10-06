<?php

namespace A3\Communication\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Lettre {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island")
     */
    protected $adresse_island;

    /** @ORM\Column(type="string") */
    protected $message;

}
