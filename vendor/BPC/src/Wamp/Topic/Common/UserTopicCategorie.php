<?php

namespace BPC\Wamp\Topic\Common;

use BPC\Wamp\Topic\Common\User\LoginTopic;
use BPC\Wamp\TopicCategorie;

class UserTopicCategorie extends TopicCategorie {

    public function __construct($Root, $Namespace, $name = "user") {
        parent::__construct($Root, $Namespace, $name);
        $this->add(new LoginTopic($Root, $Namespace, $this));
    }

}
