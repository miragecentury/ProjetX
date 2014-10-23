<?php

namespace BPC\Wamp\Topic\System;

use BPC\Wamp\TopicCategorie;

class PingTopicCategorie extends TopicCategorie {

    public function __construct($Root, $Namespace, $name = "ping") {
        parent::__construct($Root, $Namespace, $name);
    }

}