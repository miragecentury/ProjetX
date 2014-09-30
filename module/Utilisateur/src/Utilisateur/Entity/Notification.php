<?php

namespace Utilisateur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Notification {

    const ForAdmin = 2;
    const ForModer = 1;
    const ForUtili = 0;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;

    /** @ORM\Column(type="string") */
    protected $message;

    /** @ORM\Column(type="string") */
    protected $url;

    /** @ORM\Column(type="integer") */
    protected $for;

}
