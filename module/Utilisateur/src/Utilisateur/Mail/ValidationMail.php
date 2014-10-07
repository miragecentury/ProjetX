<?php

namespace Utilisateur\Mail;

use A3\Common\Entity\User;
use BPC\Mail\DefaultMail;

class ValidationMail extends DefaultMail {

    public function __construct(User $User) {
        $this->pathToLayout = __DIR__ . "../../../view/layout/layout_email.phtml";
        $this->pathToTemplate = __DIR__ . "../../../view/email/validate.phtml";
        $this->subject = "Black Pony Company - Email de Confirmation et d'activation du compte.";
        $this->emailFrom = "sender@nordri.fr";
        $this->emailTo = $User->getEmail();
        $this->variables = array("User" => $User);
    }

}
