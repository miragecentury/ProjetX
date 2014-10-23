<?php

namespace BPC\Wamp\Topic\System;

use BPC\Wamp\TopicCategorie;

class LogTopicCategorie extends TopicCategorie {

    public function __construct($Root, $Namespace, $name = "log") {
        parent::__construct($Root, $Namespace, $name);
    }

}