<?php

namespace BPC\Mail;

use Exception;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplateMapResolver;

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
        $message->setEncoding("UTF-8");
        $html = new MimePart($this->render());
        $html->type = "text/html";
        $body = new MimeMessage();
        $body->setParts(array($html));
        $message->setBody($body);
        try {
            $transport->send($message);
        } catch (Exception $e) {
            var_dump($e);
            exit();
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
        $view = new PhpRenderer();
        $resolver = new TemplateMapResolver();
        $resolver->setMap(array(
            'mailLayout' => $this->pathToLayout,
            'mailTemplate' => $this->pathToTemplate
        ));
        $view->setResolver($resolver);

        $viewModel = new ViewModel();
        $viewModel->setTemplate('mailTemplate')
                ->setVariables($this->variables);

        $content = $view->render($viewModel);

        $viewLayout = new ViewModel();
        $viewLayout->setTemplate('mailLayout')
                ->setVariables(array(
                    'content' => $content
        ));

        return $view->render($viewLayout);
    }

}
