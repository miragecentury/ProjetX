<?php

namespace A3\Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $email;

    /** @ORM\Column(type="string") */
    protected $nom;

    /** @ORM\Column(type="string") */
    protected $prenom;

    /** @ORM\Column(type="string") */
    protected $username;

    /** @ORM\Column(type="datetime") */
    protected $datenai;

    /** @ORM\Column(type="datetime") */
    protected $datecrea;

    /**     * */

    /** @ORM\Column(type="integer") */
    protected $preniumLevel;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $preniumEndDate;

    /**     * */

    /** @ORM\Column(type="string") */
    protected $salt;

    /** @ORM\Column(type="string") */
    protected $hash;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $isAdmin = false;

    /** @ORM\Column(type="boolean") */
    protected $isModo = false;

    /** @ORM\Column(type="boolean") */
    protected $isTech = false;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $isAuthorizeConnect = false;

    /** @ORM\Column(type="boolean") */
    protected $isAuthorizeConnectDev = false;

    /**     * */

    /** @ORM\Column(type="boolean") */
    protected $isLauncherConnected = false;

    /** @ORM\Column(type="boolean") */
    protected $isGameConnected = false;

    /** @ORM\Column(type="boolean") */
    protected $isNavConnected = false;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $lastLauncherConnected;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $lastGameConnected;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $lastNavConnected;

    /**     * */

    /** @ORM\Column(type="integer") */
    protected $respect = 0;

    /** @ORM\Column(type="integer") */
    protected $control = 0;

    /**     * */

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $banDateTTL;

    /**     * */

    /**
     * @ORM\OneToMany(targetEntity="A3\Common\Entity\Personnage",mappedBy="User")
     */
    protected $Personnages;

    /**     * */

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\Side", inversedBy="Users")
     */
    protected $Side;

    /**
     * @ORM\ManyToOne(targetEntity="A3\Common\Entity\Grade", inversedBy="Users")
     */
    protected $Grade;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $lastGradeChange;

    /*     * **************************************************************** */

    public function getSalt() {
        return $this->salt;
    }

    public function getHash() {
        return $this->hash;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    public function setHash($hash) {
        $this->hash = $hash;
        return $this;
    }

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getUsername() {
        return $this->username;
    }

    function getDatenai() {
        return $this->datenai;
    }

    function getDatecrea() {
        return $this->datecrea;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    function setDatenai($datenai) {
        $this->datenai = $datenai;
        return $this;
    }

    function setDatecrea($datecrea) {
        $this->datecrea = $datecrea;
        return $this;
    }

    function getIsAdmin() {
        return $this->isAdmin;
    }

    function getIsModo() {
        return $this->isModo;
    }

    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    function setIsModo($isModo) {
        $this->isModo = $isModo;
        return $this;
    }

    function getIsTech() {
        return $this->isTech;
    }

    function getIsAuthorizeConnect() {
        return $this->isAuthorizeConnect;
    }

    function getIsAuthorizeConnectDev() {
        return $this->isAuthorizeConnectDev;
    }

    function setIsTech($isTech) {
        $this->isTech = $isTech;
        return $this;
    }

    function setIsAuthorizeConnect($isAuthorizeConnect) {
        $this->isAuthorizeConnect = $isAuthorizeConnect;
        return $this;
    }

    function setIsAuthorizeConnectDev($isAuthorizeConnectDev) {
        $this->isAuthorizeConnectDev = $isAuthorizeConnectDev;
        return $this;
    }

}
