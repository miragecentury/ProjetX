<?php

namespace BPC\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class DefaultMail implements ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    protected $emailTo;
    protected $emailFrom;
    protected $subject;
    protected $pathToLayout;
    protected $pathToTemplate;
    protected $variables;

    public function sendme() {
        $transport = $this->getTransport();
        $message = new Message();
        $message->setTo($this->emailTo);
        $message->setFrom($this->emailFrom);
        $message->setSubject($this->subject);
        $message->setBody($this->render());
        try {
            $transport->send($message);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * 
     * @return Smtp
     */
    protected function getTransport() {
        return $this->getServiceLocator()->get("Zend\Mail\Transport");
    }

    protected function render() {
        $view = new \Zend\View\Renderer\PhpRenderer();
        $resolver = new \Zend\View\Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailLayout' => $this->pathToLayout,
            'mailTemplate' => $this->pathToTemplate
        ));
        $view->setResolver($resolver);
        
        $viewModel = new \Zend\View\Model\ViewModel();
        $viewModel->setTemplate('mailTemplate')
                ->setVariables($this->variables);

        $content = $view->render($viewModel);

        $viewLayout = new \Zend\View\Model\ViewModel();
        $viewLayout->setTemplate('mailLayout')
                ->setVariables(array(
                    'content' => $content
        ));

        return $view->render($viewLayout);
    }

}
