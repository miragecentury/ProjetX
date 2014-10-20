<?php

namespace BPC\Wamp;

use BPC\Wamp\WampServer;
use Exception;
use Ratchet\ConnectionInterface;

class Topic extends WampServer {

    const TOPIC = "projetx.login";

    /**
     *
     * @var Main 
     */
    private $root;
    private $ChildsTopic = array();

    public function __construct(Main $root) {
        $this->root;
    }

    public function addSubTopic(SubTopic $subtopic) {
        
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
