<?php

namespace BPC\Wamp;

use BPC\Wamp\Main;
use Ratchet\App as RatchetApp;
use Ratchet\ComponentInterface;
use React\EventLoop\LoopInterface;

class App extends RatchetApp {

    private $main;

    public function __construct(LoopInterface $loop = null, $httpHost = "projetx.nordri.fr", $port = 8080, $address = '0.0.0.0') {
        parent::__construct($httpHost, $port, $address, $loop);
        $this->main = new Main("ws.projetx");
        $this->route("/", $this->main, array("localhost", "ip.nordri.fr", "nordri.fr", "projetx.nordri.fr", "*.nordri.fr", "*"));
    }

    public function route($path, ComponentInterface $controller, array $allowedOrigins = array("*", "nordri.fr", "ip.nordri.fr", "projetx.nordri.fr"), $httpHost = null) {
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
        $Event = new Event();
        $Event->unserialize($message);
        $this->main->onInternalMessage($Event);
    }

}
