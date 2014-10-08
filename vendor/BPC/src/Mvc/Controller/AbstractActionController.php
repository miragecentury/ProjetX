<?php

namespace BPC\Mvc\Controller;

use A3\Entity\User;
use Zend\Mvc\Controller as ZController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class AbstractActionController extends ZController\AbstractActionController {

    const needAuth = false;
    const needAuthorize = false;
    const needAuthorizeDev = false;
    const needAuthModo = false;
    const needAuthAdmin = false;
    const needAuthTech = false;
    const activeFullLayout = false;

    private $User = null;
    private $alreadyUpdate = false;

    /**
     * 
     * @return User
     */
    public function getCurrentUser() {
        $userMapper = $this->getServiceLocator()->get("A3\Common\Mapper\User");
        $User = $userMapper->findOneByEmail($this->User->getEmail());
        return $User;
    }

    public function onDispatch(MvcEvent $e) {
        if (static::needAuth) {
            $auth = $this->getServiceLocator()->get("Zend\Authentication\AuthenticationService");
            if (!$auth->hasIdentity()) {
                return $this->redirect()->toRoute("home_login");
            } else {
                $this->User = $auth->getIdentity();
                $this->getCurrentUser();
                if (static::needAuthorize && !(
                        $this->getCurrentUser()->getIsAdmin() ||
                        $this->getCurrentUser()->getIsModo() ||
                        $this->getCurrentUser()->getIsTech() ||
                        $this->getCurrentUser()->getIsAuthorizeConnectDev() ||
                        $this->getCurrentUser()->getIsAuthorizeConnect()
                        )) {
                    $auth->clearIdentity();
                    return $this->redirect()->toRoute("home_noauth");
                }

                if (static::needAuthorizeDev && !(
                        $this->getCurrentUser()->getIsAdmin() ||
                        $this->getCurrentUser()->getIsTech() ||
                        $this->getCurrentUser()->getIsModo() ||
                        $this->getCurrentUser()->getIsAuthorizeConnectDev()
                        )
                ) {
                    $auth->clearIdentity();
                    return $this->redirect()->toRoute("home_noauth");
                }

                if (static::needAuthAdmin && !$this->getCurrentUser()->getIsAdmin()) {
                    $auth->clearIdentity();
                    return $this->redirect()->toRoute("home_noauth");
                }
                if (static::needAuthModo && !($this->getCurrentUser()->getIsAdmin() || $this->getCurrentUser()->getIsModo())) {
                    $auth->clearIdentity();
                    return $this->redirect()->toRoute("home_noauth");
                }
                if (static::needAuthTech && !($this->getCurrentUser()->getIsAdmin() || $this->getCurrentUser()->getIsTech())) {
                    $auth->clearIdentity();
                    return $this->redirect()->toRoute("home_noauth");
                }
            }
            $return = parent::onDispatch($e);
            if (static::activeFullLayout) {
                $this->customFullLayout();
            }
            return $return;
        }
    }

    function customFullLayout() {
        $this->layout("layout/layout_gamehub");
        $layout_part_user = new ViewModel(array("identity" => $this->getCurrentUser()));
        $layout_part_user->setTemplate("layout/layout_gamehub_part_user");
        $this->layout()->addChild($layout_part_user, "part_user");

        $layout_part_menuleft = new ViewModel(array("identity" => $this->getCurrentUser()));
        $layout_part_menuleft->setTemplate("layout/layout_gamehub_part_menuleft");
        $this->layout()->addChild($layout_part_menuleft, "part_menuleft");

        $layout_part_notification = new ViewModel(array("identity" => $this->getCurrentUser()));
        $layout_part_notification->setTemplate("layout/layout_gamehub_part_notification");
        $this->layout()->addChild($layout_part_notification, "part_notification");

        if ($this->getCurrentUser()->getIsAdmin() or $this->getCurrentUser()->getIsModo()) {
            $layout_part_notification_modo = new ViewModel(array("identity" => $this->getCurrentUser()));
            $layout_part_notification_modo->setTemplate("layout/layout_gamehub_part_notification_modo");
            $this->layout()->addChild($layout_part_notification_modo, "part_notification_modo");
        }
    }

}
