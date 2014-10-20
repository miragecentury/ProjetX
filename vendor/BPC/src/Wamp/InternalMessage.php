<?php

namespace BPC\Wamp;

use Ratchet\Wamp\Exception;
use React\EventLoop\Factory;
use React\ZMQ\Context;

class InternalMessage {

    protected $topic;
    protected $data = array();

    public function __construct($topic, $data = array()) {
        $this->topic = $topic;
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function getTopic() {
        return $this->topic;
    }

    public static function toObject($message) {
        $message = json_decode($message, true);
        $internalMessage = new InternalMessage($message['topic'], $message['data']);
        return $internalMessage;
    }

    public static function send(InternalMessage $message) {
        // This is our new stuff
        try {
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'internalmessage');
            $socket->connect("tcp://127.0.0.1:5555");

            $socket->send(json_encode(array("topic" => $message->topic, "data" => $message->getData())));
        } catch (Exception $e) {
            //error
            echo $e->getMessage();
            exit;
        }
    }

}
