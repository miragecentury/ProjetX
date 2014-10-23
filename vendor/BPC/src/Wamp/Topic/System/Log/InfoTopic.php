<?php

namespace BPC\Wamp\Topic\System\Log;

use BPC\Wamp\Main;
use BPC\Wamp\Topic;
use BPC\Wamp\TopicCategorie;
use BPC\Wamp\TopicNamespace;
use Ratchet\ConnectionInterface;

class InfoTopic extends Topic {

    public function __construct(Main $Root, TopicNamespace $Namespace, TopicCategorie $Categorie, $name = "info") {
        parent::__construct($Root, $Namespace, $Categorie, $name);
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        return callError($id, $topic, $desc = 'NoCall', $details = null);
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        parent::onSubscribe($conn, $topic);
        $this->RatchetTopic->add($conn);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        parent::onUnSubscribe($conn, $topic);
        $this->RatchetTopic->remove($conn);
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        parent::onPublish($conn, $topic, $event, $exclude, $eligible);
    }

}
