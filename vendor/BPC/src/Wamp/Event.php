<?php

namespace BPC\Wamp;

use Exception;
use Serializable;
use Zend\Stdlib\ArraySerializableInterface;

class Event implements Serializable, ArraySerializableInterface {

    const TOPIC = "";

    protected $topic;
    protected $data = array();

    public function __construct($data = array()) {
        $this->topic = static::TOPIC;
        $this->setData($data);
    }

    public function setTopic($topic) {
        $this->topic = $topic;
    }

    public function getTopic() {
        return $this->topic;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function serialize() {
        return json_encode($this->getArrayCopy());
    }

    public function unserialize($serialized) {
        return $this->exchangeArray(json_decode($serialized, true));
    }

    public function exchangeArray(array $array) {
        if (isset($array['topic'])) {
            if ($array['topic'] == static::TOPIC || static::TOPIC == "") {
                if (isset($array['data'])) {
                    $this->setData($array['data']);
                    $this->setTopic($array['topic']);
                    return $this;
                }
            } else {
                throw new Exception("Can't unserialize, topic not valid", 000);
            }
        }
        throw new Exception("Can't unserialize format not valid", 000);
    }

    public function getArrayCopy() {
        return array("topic" => $this->getTopic(), "data" => $this->getData());
    }

    public function sendInternalEvent() {
        // This is our new stuff
        try {
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'internalmessage');
            $socket->connect("tcp://127.0.0.1:5555");
            $socket->send($this->serialize());
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

}
