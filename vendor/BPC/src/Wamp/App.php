<?php

namespace BPC\Wamp;

use BPC\Wamp\Main;
use Ratchet\App as RatchetApp;
use Ratchet\ComponentInterface;
use React\EventLoop\LoopInterface;

class App extends RatchetApp {

    private $main;

    public function __construct(LoopInterface $loop = null, $httpHost = 'projetx.local', $port = 8080, $address = '0.0.0.0') {
        parent::__construct($httpHost, $port, $address, $loop);
        $this->main = new Main();
        $this->route("/", $this->main);
    }

    public function route($path, ComponentInterface $controller, array $allowedOrigins = array(), $httpHost = null) {
        return parent::route($path, $controller, $allowedOrigins, $httpHost);
    }

    public function run() {
        parent::run();
    }

    public function onMessage($message) {
        echo "##############################" . PHP_EOL;
        echo "# Message : Application PHP :#" . PHP_EOL;
        echo $message . PHP_EOL;
        echo "##############################" . PHP_EOL;
        $this->main->onInternalMessage(InternalMessage::toObject($message));
    }

}