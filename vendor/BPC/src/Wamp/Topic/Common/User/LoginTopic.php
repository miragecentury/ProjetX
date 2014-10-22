<?php

namespace BPC\Wamp\Topic\Common\User;

use BPC\Wamp\Event;
use BPC\Wamp\Main;
use BPC\Wamp\Topic;
use BPC\Wamp\Topic\Common\User\Event\LoginEvent;
use BPC\Wamp\TopicCategorie;
use BPC\Wamp\TopicNamespace;
use Ratchet\ConnectionInterface;

class LoginTopic extends Topic {

    public function __construct(Main $Root, TopicNamespace $Namespace, TopicCategorie $Categorie, $name = "login") {
        parent::__construct($Root, $Namespace, $Categorie, $name);
    }

    public function onInternalMessage(Event $message) {
        var_dump($message);
        echo "Broadcast InternalMessage ws.projetx.common.user.login" . PHP_EOL;
        $this->RatchetTopic->broadcast($message->serialize());
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        echo "Suscribe ws.projetx.common.user.login" . PHP_EOL;
        parent::onSubscribe($conn, $topic);
        $this->RatchetTopic->add($conn);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        parent::onUnSubscribe($conn, $topic);
        $this->RatchetTopic->remove($conn);
    }

}
