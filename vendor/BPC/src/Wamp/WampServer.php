<?php

namespace BPC\Wamp;

use Ratchet\Wamp\WampServerInterface;

abstract class WampServer implements WampServerInterface {

    abstract public function onClose(\Ratchet\ConnectionInterface $conn);

    abstract public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e);

    abstract public function onOpen(\Ratchet\ConnectionInterface $conn);

    abstract public function onCall(\Ratchet\ConnectionInterface $conn, $id, $topic, array $params);

    abstract public function onPublish(\Ratchet\ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible);

    abstract public function onSubscribe(\Ratchet\ConnectionInterface $conn, $topic);

    abstract public function onUnSubscribe(\Ratchet\ConnectionInterface $conn, $topic);

    abstract public function onInternalMessage(Event $message);
}
