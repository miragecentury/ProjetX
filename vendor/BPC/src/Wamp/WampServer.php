<?php

namespace BPC\Wamp;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;
use Ratchet\Wamp\WampServerInterface;

abstract class WampServer implements WampServerInterface {

    abstract public function onClose(ConnectionInterface $conn);

    abstract public function onError(ConnectionInterface $conn, Exception $e);

    abstract public function onOpen(ConnectionInterface $conn);

    abstract public function onCall(ConnectionInterface $conn, $id, $topic, array $params);

    abstract public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible);

    abstract public function onSubscribe(ConnectionInterface $conn, $topic);

    abstract public function onUnSubscribe(ConnectionInterface $conn, $topic);

    abstract public function onInternalMessage(Event $message);
}
