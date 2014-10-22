<?php

namespace BPC\Wamp;

use BPC\Wamp\Main;
use Ratchet\App as RatchetApp;
use Ratchet\ComponentInterface;
use Ratchet\Wamp\WampServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\LoopInterface;
use Symfony\Component\Routing\Route;

class App extends RatchetApp {

    private $main;

    public function __construct($Zendapp, LoopInterface $loop = null, $httpHost = "projetx.nordri.fr", $port = 8080, $address = '0.0.0.0') {
        parent::__construct($httpHost, $port, $address, $loop);
        $this->main = new Main($Zendapp, "ws.projetx");
        $this->route("/", $this->main, array('*'));
    }

//    public function route($path, ComponentInterface $controller, array $allowedOrigins = array("*", "projetx.local", "nordri.fr", "ip.nordri.fr", "projetx.nordri.fr"), $httpHost = null) {
//        $decorator = new WsServer(new WampServer($controller));
//        $this->routes->add('rr-' . ++$this->_routeCounter, new Route($path, array('_controller' => $decorator), array('Origin' => $this->httpHost), array(), $httpHost));
//        return $decorator;
//    }

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
