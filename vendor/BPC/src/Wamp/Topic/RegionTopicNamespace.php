<?php

namespace BPC\Wamp\Topic;

use BPC\Wamp\TopicNamespace;

class RegionTopicNamespace extends TopicNamespace {

    public function __construct($Root, $name) {
        parent::__construct($Root, $name);
    }

}
