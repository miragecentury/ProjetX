<?php

namespace BPC\Wamp\Topic\Common\User;

use BPC\Wamp\Event;
use BPC\Wamp\Main;
use BPC\Wamp\Topic;
use BPC\Wamp\TopicCategorie;
use BPC\Wamp\TopicNamespace;
use Ratchet\ConnectionInterface;

class LoginTopic extends Topic {

    public function __construct(Main $Root, TopicNamespace $Namespace, TopicCategorie $Categorie, $name = "login") {
        parent::__construct($Root, $Namespace, $Categorie, $name);
    }

    public function onInternalMessage(Event $message) {
        $this->RatchetTopic->broadcast($message->serialize());
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        echo "CALL LOGIN" . PHP_EOL;
        $UserService = $this->Root->getServiceLocator()->get("A3\Common\Service\User");
        if (count($params) >= 3) {
            $token = $UserService->getToken($params[0], $params[1], $params[2]);
            var_dump(array("email" => $params[0], "token" => $token));
        } else {
            $token = null;
        }
        return $conn->callResult($id, array("email" => $params[0], "token" => $token));
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        parent::onSubscribe($conn, $topic);
        $this->RatchetTopic->add($conn);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        parent::onUnSubscribe($conn, $topic);
        $this->RatchetTopic->remove($conn);
    }

}
