<?php

namespace A3\Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Grade {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $label;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\Side", inversedBy="Grades")
     */
    protected $Side;

    /*     * * */

    /** @ORM\OneToOne(targetEntity="Grade") */
    protected $previousGrade;

    /** @ORM\OneToOne(targetEntity="Grade") */
    protected $nextGrade;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $minTimeToNextGrade;

    /** @ORM\Column(type="boolean") */
    protected $nextGradeNeedPost = false;

    /*     * * */

    /** @ORM\Column(type="string") */
    protected $Icon;

    /** @ORM\Column(type="string") */
    protected $IconConfig;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\User",mappedBy="Grade")
     */
    protected $Users;

    /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\Personnage",mappedBy="Grade")
     */
    protected $Personnages;

}
