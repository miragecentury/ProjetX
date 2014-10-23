<?php

namespace BPC\Wamp;

use Exception;
use Ratchet\ConnectionInterface;

class TopicCategorie extends WampServer {

    use WampServerInterfaceTrait;

    protected $name;
    /**
     *
     * @var Main 
     */
    protected $Root;
    protected $TopicNamespace;
    protected $Topics = array();

    public function getName() {
        return $this->name;
    }

    public function getTopicNamespace() {
        return $this->$TopicNamespace;
    }

    public function __construct(Main $Root, $TopicNamespace, $name) {
        $this->Root = $Root;
        $this->TopicNamespace = $TopicNamespace;
        $this->name = $name;
    }

    public function add(Topic $Topic) {
        if (isset($this->Topics[$Topic->getName()])) {
            throw new Exception("Topic already set", 000);
        } else {
            $this->Topics[$Topic->getName()] = $Topic;
        }
    }

    public function remove(Topic $Topic) {
        if (!isset($this->Topics[$Topic->getName()])) {
            throw new Exception("Topic not set", 000);
        } else {
            unset($this->Topics[$Topic->getName()]);
        }
    }

    public function dispatch($topic) {
        if (self::getCategorie($topic) == $this->name) {
            if (isset($this->Topics[self::getEvent($topic)])) {
                return $this->Topics[self::getEvent($topic)];
            } else {
                throw new Exception("Categorie not set", 000);
            }
        } else {
            throw new Exception("Cannot be dispatched", 000);
        }
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        return $this->dispatch($topic)->onCall($conn, $id, $topic, $params);
    }

    public function onClose(ConnectionInterface $conn) {
        return $this->dispatch($topic)->onClose($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        return $this->dispatch($topic)->onError($conn, $e);
    }

    public function onOpen(ConnectionInterface $conn) {
        return $this->dispatch($topic)->onOpen($conn);
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        return $this->dispatch($topic)->onPublish($conn, $topic, $event, $exclude, $eligible);
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        return $this->dispatch($topic)->onSubscribe($conn, $topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        return $this->dispatch($topic)->onUnSubscribe($conn, $topic);
    }

    public function onInternalMessage(Event $event) {
        $this->dispatch($event->getTopic())->onInternalMessage($event);
    }

}
