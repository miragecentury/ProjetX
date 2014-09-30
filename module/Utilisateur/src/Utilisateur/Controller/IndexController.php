<?php

namespace Utilisateur\Controller;

use BPC\Mvc\Controller\AbstractActionController;
use BPC\Service\Gunof;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    const needAuth = true;
    const needAuthorizeDev = true;
    const activeFullLayout = true;

    public function indexAction() {
        return new ViewModel();
    }

}
