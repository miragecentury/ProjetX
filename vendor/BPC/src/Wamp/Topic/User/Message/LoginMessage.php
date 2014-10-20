<?php

namespace BPC\Wamp\Topic\User\Message;

class LoginMessage extends BPC\Wamp\InternalMessage {

    const TOPIC = "projetx.user.login";

    protected $ip;
    protected $datetime;
    protected $id;
    protected $email;

    public function __construct($ip, $datetime, $id, $email) {
        parent::__construct(self::TOPIC, array(
            "ip" => $ip,
            "datetime" => $datetime,
            "id" => $id,
            "email" => $email,
        ));
        $this->ip = $ip;
        $this->email = $email;
        $this->id = $id;
        $this->datetime = $datetime;
    }

    public static function toObject($message) {
        $message = json_decode($message, true);
        if ($message['topic'] == self::TOPIC) {
            return new LoginMessage($message['data']['ip'], $message['data']['datetime'], $message['data']['id'], $message['data']['email']);
        } else {
            return null;
        }
    }

}
