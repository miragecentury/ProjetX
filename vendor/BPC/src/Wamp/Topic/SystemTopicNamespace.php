<?php

namespace BPC\Wamp\Topic;

use BPC\Wamp\Topic\Common\UserTopicCategorie;
use BPC\Wamp\TopicNamespace;

class SystemTopicNamespace extends TopicNamespace {

    public function __construct($Root, $name = "system") {
        parent::__construct($Root, $name);
        $this->add(new System\LogTopicCategorie($Root, $this));
        $this->add(new System\PingTopicCategorie($Root, $this));
    }

}
