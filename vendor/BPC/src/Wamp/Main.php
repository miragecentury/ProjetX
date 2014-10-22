<?php

namespace BPC\Wamp;

use BPC\Wamp\WampServer;
use Exception;
use Ratchet\ConnectionInterface;

class Main extends WampServer {

    protected $root;
    protected $TopicNamespaces = array();
    protected $Connections = array();
    protected $AuthenticateConnections = array();

    public function __construct($root) {
        $this->root = $root;
        $this->add(new Topic\CommonTopicNamespace($this));
    }

    public function getRootTopic() {
        return $this->root;
    }

    public function add(TopicNamespace $TopicNamespace) {
        if (isset($this->TopicNamespaces[$TopicNamespace->getName()])) {
            throw new Exception("TopicNamespace already set", 000);
        } else {
            $this->TopicNamespaces[$TopicNamespace->getName()] = $TopicNamespace;
        }
    }

    public function remove(TopicCategorie $TopicNamespace) {
        if (!isset($this->TopicNamespaces[$TopicNamespace->getName()])) {
            throw new Exception("TopicNamespace not set", 000);
        } else {
            unset($this->TopicNamespaces[$TopicNamespace->getName()]);
        }
    }

    /**
     * 
     * @param type $topic
     * @return TopicNamespace
     * @throws Exception
     */
    public function dispatch($topic) {
        if (self::getRoot($topic) == $this->root) {
            if (isset($this->TopicNamespaces[self::getNamespace($topic)])) {
                return $this->TopicNamespaces[self::getNamespace($topic)];
            } else {
                throw new Exception("TopicNamespace Inconnu", 000);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        //Delegate To All TopicNamespace
        if (isset($this->Connections[$conn->resourceId])) {
            unset($this->Connections[$conn->resourceId]);
        } else {
            throw new Exception("COnnection Ressource Id notset ??? but close", 000);
        }
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        //Delegate To All TopicNamespace
    }

    public function onOpen(ConnectionInterface $conn) {
        echo "Main : CONNECTION : start" . PHP_EOL;
        //Delegate To All TopicNamespace
        if (!isset($this->Connections[$conn->resourceId])) {
            $this->Connections[$conn->resourceId] = $conn;
        } else {
            throw new Exception("Connection RessourceId already defined", 000);
        }
        echo "Main : CONNECTION : end" . PHP_EOL;
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        //Need Check Authentification
        //Delegate To TopicNamespace
        $this->dispatch($topic)->onCall($conn, $id, $topic, $params);
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        //Need Check Authentification
        //Delegate To TopicNamespace
        $this->dispatch($topic)->onPublish($conn, $topic, $event, $exclude, $eligible);
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        echo "MAIN :: onSuscribe" . PHP_EOL;
        //Need Check Authentification
        //Delegate To TopicNamespace
        $this->dispatch($topic)->onSubscribe($conn, $topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        //Delegate To TopicNamespace
        $this->dispatch($topic)->onUnSubscribe($conn, $topic);
    }

    public function onInternalMessage(Event $event) {
        //Convert to 
        $this->dispatch($event->getTopic())->onInternalMessage($event);
    }

    public function __destruct() {
        foreach ($this->Connections as $conn) {
            $conn->close();
        }
        foreach ($this->TopicNamespaces as $TopicNamespace) {
            $this->remove($TopicNamespace);
        }
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
