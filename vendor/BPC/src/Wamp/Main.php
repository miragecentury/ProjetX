<?php

namespace BPC\Wamp;

use BPC\Wamp\WampServer;
use Exception;
use Ratchet\ConnectionInterface;

class Main extends WampServer {

    protected $mainTopics = array();

    public function __construct() {
        
    }

    public function add(Topic $topic) {
        
    }

    public function onClose(ConnectionInterface $conn) {
        //Delegate To All Topic
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        //Delegate To All Topic
    }

    public function onOpen(ConnectionInterface $conn) {
        //Delegate To All Topic
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        //Delegate To Topic
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        //Delegate To Topic
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        //Need Check Authentification
        //Delegate To Topic
        $topic->add($conn);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        //Delegate To Topic
        $topic->remove($conn);
    }

    public function onInternalMessage(InternalMessage $message) {
        $topic = $message->getTopic();
    }

}
