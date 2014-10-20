<?php

namespace Administrateur\Controller;

use Administrateur\Form\Side\Add;
use BPC\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GradeController extends AbstractActionController {

    const needAuth = true;
    const needAuthModo = false;
    const needAuthAdmin = true;
    const activeFullLayout = true;

    public function addAction() {
        
    }

}
