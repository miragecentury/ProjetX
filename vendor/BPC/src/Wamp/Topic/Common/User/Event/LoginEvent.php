<?php

namespace BPC\Wamp\Topic\Common\User\Event;

use BPC\Wamp\Event as BpcEvent;

class LoginEvent extends BpcEvent {

    const TOPIC = "ws.projetx.common.user.login";

    protected $UserId;
    protected $UserEmail;
    protected $Username;
    protected $TimeStamp;

    public function __construct($UserId, $UserEmail, $UserUsername, $TimeStamp) {
        $data = array(
            "User.Id" => $UserId,
            "User.Email" => $UserEmail,
            "Username" => $UserUsername,
            "TimeStamp" => $TimeStamp,
        );
        parent::__construct($data);
        $this->UserId = $UserId;
        $this->UserEmail = $UserEmail;
        $this->Username = $UserUsername;
        $this->TimeStamp = $TimeStamp;
    }

    public function getData() {
        $this->data = array(
            "User.Id" => $this->UserId,
            "User.Email" => $this->UserEmail,
            "Username" => $this->Username,
            "TimeStamp" => $this->TimeStamp,
        );
        return parent::getData();
    }

    public function setData($data) {
        parent::setData($data);
        $this->UserId = $this->data["User.Id"];
        $this->UserEmail = $this->data["User.Email"];
        $this->Username = $this->data["Username"];
        $this->TimeStamp = $this->data["TimeStamp"];
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

    public function sendInternalEvent() {
        parent::sendInternalEvent();
    }

}
