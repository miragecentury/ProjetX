<?php

namespace BPC\Wamp\Topic;

use BPC\Wamp\Topic\Common\UserTopicCategorie;
use BPC\Wamp\TopicNamespace;

class CommonTopicNamespace extends TopicNamespace {

    public function __construct($Root, $name = "common") {
        parent::__construct($Root, $name);

        $this->add(new UserTopicCategorie($Root, $this));
    }

}
