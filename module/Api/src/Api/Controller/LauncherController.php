<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class LauncherController extends AbstractActionController {

    public function statutAction() {
        return new JsonModel(array("ok" => true));
    }

}
