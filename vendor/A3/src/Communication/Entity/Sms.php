<?php

namespace A3\Communication\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Sms {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Communication\Entity\Appcom")
     */
    protected $emetteur;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island")
     */
    protected $emetteurIsland;

    /** @ORM\Column(type="string") */
    protected $emetteurGps;

    /** @ORM\Column(type="datetime") */
    protected $emetteurDate;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Communication\Entity\Appcom")
     */
    protected $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Region\Entity\Island")
     */
    protected $destinataireIsland;

    /** @ORM\Column(type="string") */
    protected $destinataireGps;

}
