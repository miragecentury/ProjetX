<?php

namespace BPC\Wamp;

use BPC\Wamp\WampServer;
use Ratchet\ConnectionInterface as ConnectionInterface2;
use Ratchet\Wamp\Exception;
use Ratchet\Wamp\Topic as RTopic;
use Zend\Db\Adapter\Driver\ConnectionInterface;

class Topic extends WampServer {

    protected $name;
    protected $Root;
    protected $Namespace;
    protected $Categorie;
    protected $RatchetTopic;

    public function __construct(Main $Root, TopicNamespace $Namespace, TopicCategorie $Categorie, $name) {
        $this->name = $name;
        $this->Root = $Root;
        $this->Namespace = $Namespace;
        $this->Categorie = $Categorie;
        $this->RatchetTopic = new RTopic($this->Root->getRootTopic() . "." . $this->Namespace->getName() . "." . $this->Categorie->getName() . "." . $this->name);
    }

    public function getName() {
        return $this->name;
    }

    public function onCall(ConnectionInterface2 $conn, $id, $topic, array $params) {
        
    }

    public function onClose(ConnectionInterface2 $conn) {
        
    }

    public function onError(ConnectionInterface2 $conn, \Exception $e) {
        
    }

    public function onInternalMessage(Event $message) {
        
    }

    public function onOpen(\Ratchet\ConnectionInterface $conn) {
        
    }

    public function onPublish(\Ratchet\ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        
    }

    public function onSubscribe(\Ratchet\ConnectionInterface $conn, $topic) {
        
    }

    public function onUnSubscribe(\Ratchet\ConnectionInterface $conn, $topic) {
        
    }

    public function getRoot($topic) {
        $regex = "#^ws\.([a-zA-Z]+)\.#";
        $matches = array();
        preg_match($regex, $topic, $matches);
        if (isset($matches[1])) {
            return "ws." . $matches[1];
        } else {
            throw new Exception("Cannot get Root topic", 000);
        }
    }

    static public function getNamespace($topic) {
        $regex = "#^" . str_replace(".", "\.", self::getRoot($topic)) . "\.([a-zA-Z]+)#";
        $matches = array();
        preg_match($regex, $topic, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception("Cannot get NamespaceF topic", 000);
        }
    }

    static public function getCategorie($topic) {
        $regex = "#^" . str_replace(".", "\.", self::getRoot($topic)) . "\." . self::getNamespace($topic) . "\.([a-zA-Z]+)#";
        $matches = array();
        preg_match($regex, $topic, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception("Cannot get Root topic", 000);
        }
    }

    static public function getEvent($topic) {
        $regex = "#^" . str_replace(".", "\.", self::getRoot($topic)) . "\." . self::getNamespace($topic) . "\." . self::getCategorie($topic) . "\.([a-zA-Z]+)$#";
        $matches = array();
        preg_match($regex, $topic, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception("Cannot get Root topic", 000);
        }
    }

}
