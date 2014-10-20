<?php

use Exception;
use BPC\Wamp\WampServer;
use React\Socket\ConnectionInterface;

namespace BPC\Wamp;

class SubTopic extends WampServer {

    private $MainTopic;
    private $ParentTopic;
    private $ChildsTopic = array();

    public function __construct() {
        
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        
    }

    public function onClose(ConnectionInterface $conn) {
        
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        
    }

    public function onOpen(ConnectionInterface $conn) {
        
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        
    }

}
