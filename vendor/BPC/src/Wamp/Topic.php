<?php

namespace BPC\Wamp;

use BPC\Wamp\WampServer;
use Ratchet\ConnectionInterface as ConnectionInterface2;
use Ratchet\Wamp\Exception;
use Ratchet\Wamp\Topic as RTopic;
use Zend\Db\Adapter\Driver\ConnectionInterface;

class Topic extends WampServer {

    use WampServerInterfaceTrait;

    protected $name;

    /**
     *
     * @var Main 
     */
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
        return callError($id, $topic, $desc = 'EmptyDeclaration', $details = null);
    }

    public function onClose(ConnectionInterface2 $conn) {
        //Nothing
    }

    public function onError(ConnectionInterface2 $conn, \Exception $e) {
        //Nothing
    }

    public function onInternalMessage(Event $message) {
        $this->RatchetTopic->broadcast($message->serialize());
    }

    public function onOpen(\Ratchet\ConnectionInterface $conn) {
        //Nothing
    }

    public function onPublish(\Ratchet\ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        //Nothing
    }

    public function onSubscribe(\Ratchet\ConnectionInterface $conn, $topic) {
        //Nothing
    }

    public function onUnSubscribe(\Ratchet\ConnectionInterface $conn, $topic) {
        //Nothing
    }

}
