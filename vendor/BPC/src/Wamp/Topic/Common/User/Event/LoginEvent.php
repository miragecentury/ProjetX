<?php

namespace BPC\Wamp\Topic\Common\User\Event;

use BPC\Wamp\Event as BpcEvent;

class LoginEvent extends BpcEvent {

    const TOPIC = "ws.projetx.common.user.login";
    const LOGIN_GAMEHUB = 0;
    const LOGIN_WS = 1;
    const LOGIN_API = 1;

    protected $UserId;
    protected $UserEmail;
    protected $Username;
    protected $TypeLogin;
    protected $TimeStamp;

    public function __construct($UserId, $UserEmail, $UserUsername, $TimeStamp, $typeLogin) {
        $data = array(
            "UserId" => $UserId,
            "UserEmail" => $UserEmail,
            "Username" => $UserUsername,
            "TimeStamp" => $TimeStamp,
            "TypeLogin" => $typeLogin,
        );
        parent::__construct($data);
        $this->UserId = $UserId;
        $this->UserEmail = $UserEmail;
        $this->Username = $UserUsername;
        $this->TimeStamp = $TimeStamp;
        $this->TypeLogin = $typeLogin;
    }

    public function getData() {
        $this->data = array(
            "UserId" => $this->UserId,
            "UserEmail" => $this->UserEmail,
            "Username" => $this->Username,
            "TimeStamp" => $this->TimeStamp,
            "TypeLogin" => $this->TypeLogin,
        );
        return parent::getData();
    }

    public function setData($data) {
        parent::setData($data);
        $this->UserId = $this->data["UserId"];
        $this->UserEmail = $this->data["UserEmail"];
        $this->Username = $this->data["Username"];
        $this->TimeStamp = $this->data["TimeStamp"];
        $this->TypeLogin = $this->data["TypeLogin"];
    }

    function getUserId() {
        return $this->UserId;
    }

    function getUserEmail() {
        return $this->UserEmail;
    }

    function getUsername() {
        return $this->Username;
    }

    function getTimeStamp() {
        return $this->TimeStamp;
    }

    function setUserId($UserId) {
        $this->UserId = $UserId;
    }

    function setUserEmail($UserEmail) {
        $this->UserEmail = $UserEmail;
    }

    function setUsername($Username) {
        $this->Username = $Username;
    }

    function setTimeStamp($TimeStamp) {
        $this->TimeStamp = $TimeStamp;
    }

    function getTypeLogin() {
        return $this->TypeLogin;
    }

    function setTypeLogin($TypeLogin) {
        $this->TypeLogin = $TypeLogin;
    }

    public function sendInternalEvent() {
        parent::sendInternalEvent();
    }

}
