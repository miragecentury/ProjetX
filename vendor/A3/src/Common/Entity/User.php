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

    /**     * */

    /** @ORM\Column(type="datetime") */
    protected $datecrea;

    /** @ORM\Column(type="boolean") */
    protected $emailvalidate = false;

    /** @ORM\Column(type="string",nullable=true) */
    protected $emailvalidatetoken;

    /** @ORM\Column(type="boolean") */
    protected $firstconnect = true;
    /**     * */

    /** @ORM\Column(type="integer") */
    protected $preniumLevel = 0;

    /** @ORM\Column(type="datetime",nullable=true) */
    protected $preniumEndDate;

    /**     * */

    /** @ORM\Column(type="string") */
    protected $salt;

    /** @ORM\Column(type="string") */
    protected $hash;

    /** @ORM\Column(type="string") */
    protected $tokenApiHttp;

    /** @ORM\Column(type="string") */
    protected $tokenApiWS;

    /** @ORM\Column(type="string") */
    protected $tokenApiLauncher;

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
     * @ORM\OneToMany(targetEntity="Personnage",mappedBy="User")
     */
    protected $Personnages;

    /**     * */

    /**
     * @ORM\ManyToOne(targetEntity="Side", inversedBy="Users")
     */
    protected $Side;

    /**
     * @ORM\ManyToOne(targetEntity="Grade", inversedBy="Users")
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

    function getEmailvalidate() {
        return $this->emailvalidate;
    }

    function getFirstconnect() {
        return $this->firstconnect;
    }

    function setEmailvalidate($emailvalidate) {
        $this->emailvalidate = $emailvalidate;
        return $this;
    }

    function setFirstconnect($firstconnect) {
        $this->firstconnect = $firstconnect;
        return $this;
    }

    function getEmailvalidatetoken() {
        return $this->emailvalidatetoken;
    }

    function getPreniumLevel() {
        return $this->preniumLevel;
    }

    function getPreniumEndDate() {
        return $this->preniumEndDate;
    }

    function getIsLauncherConnected() {
        return $this->isLauncherConnected;
    }

    function getIsGameConnected() {
        return $this->isGameConnected;
    }

    function getIsNavConnected() {
        return $this->isNavConnected;
    }

    function getLastLauncherConnected() {
        return $this->lastLauncherConnected;
    }

    function getLastGameConnected() {
        return $this->lastGameConnected;
    }

    function getLastNavConnected() {
        return $this->lastNavConnected;
    }

    function getRespect() {
        return $this->respect;
    }

    function getControl() {
        return $this->control;
    }

    function getBanDateTTL() {
        return $this->banDateTTL;
    }

    function getPersonnages() {
        return $this->Personnages;
    }

    function getSide() {
        return $this->Side;
    }

    function getGrade() {
        return $this->Grade;
    }

    function getLastGradeChange() {
        return $this->lastGradeChange;
    }

    function setEmailvalidatetoken($emailvalidatetoken) {
        $this->emailvalidatetoken = $emailvalidatetoken;
        return $this;
    }

    function setPreniumLevel($preniumLevel) {
        $this->preniumLevel = $preniumLevel;
        return $this;
    }

    function setPreniumEndDate($preniumEndDate) {
        $this->preniumEndDate = $preniumEndDate;
        return $this;
    }

    function setIsLauncherConnected($isLauncherConnected) {
        $this->isLauncherConnected = $isLauncherConnected;
        return $this;
    }

    function setIsGameConnected($isGameConnected) {
        $this->isGameConnected = $isGameConnected;
        return $this;
    }

    function setIsNavConnected($isNavConnected) {
        $this->isNavConnected = $isNavConnected;
        return $this;
    }

    function setLastLauncherConnected($lastLauncherConnected) {
        $this->lastLauncherConnected = $lastLauncherConnected;
        return $this;
    }

    function setLastGameConnected($lastGameConnected) {
        $this->lastGameConnected = $lastGameConnected;
        return $this;
    }

    function setLastNavConnected($lastNavConnected) {
        $this->lastNavConnected = $lastNavConnected;
        return $this;
    }

    function setRespect($respect) {
        $this->respect = $respect;
        return $this;
    }

    function setControl($control) {
        $this->control = $control;
        return $this;
    }

    function setBanDateTTL($banDateTTL) {
        $this->banDateTTL = $banDateTTL;
        return $this;
    }

    function setPersonnages($Personnages) {
        $this->Personnages = $Personnages;
        return $this;
    }

    function setSide($Side) {
        $this->Side = $Side;
        return $this;
    }

    function setGrade($Grade) {
        $this->Grade = $Grade;
        return $this;
    }

    function setLastGradeChange($lastGradeChange) {
        $this->lastGradeChange = $lastGradeChange;
        return $this;
    }

    function getTokenApiHttp() {
        return $this->tokenApiHttp;
    }

    function getTokenApiWS() {
        return $this->tokenApiWS;
    }

    function getTokenApiLauncher() {
        return $this->tokenApiLauncher;
    }

    function setTokenApiHttp($tokenApiHttp) {
        $this->tokenApiHttp = $tokenApiHttp;
        return $this;
    }

    function setTokenApiWS($tokenApiWS) {
        $this->tokenApiWS = $tokenApiWS;
        return $this;
    }

    function setTokenApiLauncher($tokenApiLauncher) {
        $this->tokenApiLauncher = $tokenApiLauncher;
        return $this;
    }

}
