<?php

namespace BPC\Wamp;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use Zend\Di\ServiceLocator;

abstract class WampServer implements WampServerInterface {

    abstract public function onClose(ConnectionInterface $conn);

    abstract public function onError(ConnectionInterface $conn, Exception $e);

    abstract public function onOpen(ConnectionInterface $conn);

    abstract public function onCall(ConnectionInterface $conn, $id, $topic, array $params);

    abstract public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible);

    abstract public function onSubscribe(ConnectionInterface $conn, $topic);

    abstract public function onUnSubscribe(ConnectionInterface $conn, $topic);

    abstract public function onInternalMessage(Event $message);

    abstract static public function getRoot($topic);

    abstract static public function getNamespace($topic);

    abstract static public function getCategorie($topic);

    abstract static public function getEvent($topic);

    abstract static public function checkSecurity($topic, $conn, ServiceLocator $em);
}

trait WampServerInterfaceTrait {

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

    static public function getRole($conn, ServiceLocator $sl) {
        return "anonymous";
    }

    static public function checkSecurity($topic, $conn, ServiceLocator $sl) {
        $sl->get("");
        return false;
    }

}
