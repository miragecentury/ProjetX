<?php

namespace BPC\Wamp;

use Exception;
use Ratchet\ConnectionInterface;

class TopicNamespace extends WampServer {

    protected $Root;
    protected $name;
    protected $TopicCategories = array();

    /**
     * 
     * @param type $Root
     * @param type $name
     */
    public function __construct($Root, $name) {
        $this->Root = $Root;
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @param TopicCategorie $TopicCategorie
     * @throws Exception
     */
    public function add(TopicCategorie $TopicCategorie) {
        if (isset($this->TopicCategories[$TopicCategorie->getName()])) {
            throw new Exception("Categorie already set", 000);
        } else {
            $this->TopicCategories[$TopicCategorie->getName()] = $TopicCategorie;
        }
    }

    /**
     * 
     * @param TopicCategorie $TopicCategorie
     * @throws Exception
     */
    public function remove(TopicCategorie $TopicCategorie) {
        if (!isset($this->TopicCategories[$TopicCategorie->getName()])) {
            throw new Exception("Categorie not set", 000);
        } else {
            unset($this->TopicCategories[$TopicCategorie->getName()]);
        }
    }

    /**
     * 
     * @param string $topic
     * @return TopicCategorie
     * @throws Exception
     */
    public function dispatch($topic) {
        if (self::getNamespace($topic) == $this->name) {
            if (isset($this->TopicCategories[self::getCategorie($topic)])) {
                return $this->TopicCategories[self::getCategorie($topic)];
            } else {
                throw new Exception("Categorie not set", 000);
            }
        } else {
            throw new Exception("Cannot be dispatched", 000);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $id
     * @param type $topic
     * @param array $params
     * @return type
     */
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        return $this->dispatch($topic)->onCall($conn, $id, $topic, $params);
    }

    /**
     * 
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onClose($conn);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param Exception $e
     */
    public function onError(ConnectionInterface $conn, Exception$e) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onError($conn, $e);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onOpen($conn);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     * @param type $event
     * @param array $exclude
     * @param array $eligible
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        $this->dispatch($topic)->onPublish($conn, $topic, $event, $exclude, $eligible);
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     */
    public function onSubscribe(ConnectionInterface $conn, $topic) {
        $this->dispatch($topic)->onSubscribe($conn, $topic);
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        $this->dispatch($topic)->onUnSubscribe($conn, $topic);
    }

    /**
     * 
     * @param InternalMessage $message
     */
    public function onInternalMessage(Event $event) {
        $this->dispatch($event->getTopic())->onInternalMessage($event);
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
