<?php

namespace BPC\Wamp;

use BPC\Wamp\Main;
use Ratchet\App as RatchetApp;
use React\EventLoop\LoopInterface;
use Zend\Mvc\Application;

class App extends RatchetApp {

    /**
     *
     * @var Main 
     */
    private $main;

    public function __construct(Application $Zendapp, LoopInterface $loop = null, $httpHost = "projetx.nordri.fr", $port = 8080, $address = '0.0.0.0') {
        parent::__construct($httpHost, $port, $address, $loop);
        $this->main = new Main($Zendapp, "ws.projetx");
        $this->route("/", $this->main, array('*'));
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
