<?php

namespace BPC\Wamp;

use Exception;
use Ratchet\ConnectionInterface;
use Zend\Mvc\Application;

class TopicNamespace extends WampServer {

    use WampServerInterfaceTrait;

    /**
     *
     * @var Application 
     */
    protected $Root;
    protected $name;
    protected $TopicCategories = array();

    /**
     * Définition d'un Topic Namespace
     * Nécessite la définition d'un Main (endpoint)
     * @param Main $Root
     * @param string $name
     */
    public function __construct(Application $Root, $name) {
        $this->Root = $Root;
        $this->name = $name;
    }

    /**
     * Récupère le nom du Namespace (valide pour les chemins de topic)
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Ajout d'une catégorie au namespace
     * @param TopicCategorie $TopicCategorie
     * @throws Exception
     */
    public function add(TopicCategorie $TopicCategorie) {
        if (isset($this->TopicCategories[$TopicCategorie->getName()])) {
            throw new Exception("Categorie already set", 000);
        } else {
            $this->TopicCategories[$TopicCategorie->getName()] = $TopicCategorie;
        }
    }

    /**
     * Supression d'une catégorie (détruit les childs de celle-ci)
     * @param TopicCategorie $TopicCategorie
     * @throws Exception
     */
    public function remove(TopicCategorie $TopicCategorie) {
        if (!isset($this->TopicCategories[$TopicCategorie->getName()])) {
            throw new Exception("Categorie not set", 000);
        } else {
            unset($this->TopicCategories[$TopicCategorie->getName()]);
        }
    }

    /**
     * Retour la Catégorie concerné par le chemin de topic, retour une exception si non trouvé
     * @param string $topic
     * @return TopicCategorie
     * @throws Exception
     */
    public function dispatch($topic) {
        if (self::getNamespace($topic) == $this->name) {
            if (isset($this->TopicCategories[self::getCategorie($topic)])) {
                return $this->TopicCategories[self::getCategorie($topic)];
            } else {
                throw new Exception("Categorie not set", 000);
            }
        } else {
            throw new Exception("Cannot be dispatched", 000);
        }
    }

    /**
     * Récupération des events onCall sur le namespace puis dispatch à la catégorie concerné
     * @param ConnectionInterface $conn
     * @param type $id
     * @param type $topic
     * @param array $params
     * @return type
     */
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        return $this->dispatch($topic)->onCall($conn, $id, $topic, $params);
    }

    /**
     * Récupération des events onClose sur le namespace puis dispatch à la catégorie concerné
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onClose($conn);
        }
    }

    /**
     * Récupération des events onClose sur le namespace puis dispatch à la catégorie concerné
     * @param ConnectionInterface $conn
     * @param Exception $e
     */
    public function onError(ConnectionInterface $conn, Exception$e) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onError($conn, $e);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn) {
        foreach ($this->TopicCategories as $TopicCategorie) {
            $TopicCategorie->onOpen($conn);
        }
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     * @param type $event
     * @param array $exclude
     * @param array $eligible
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        $this->dispatch($topic)->onPublish($conn, $topic, $event, $exclude, $eligible);
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     */
    public function onSubscribe(ConnectionInterface $conn, $topic) {
        $this->dispatch($topic)->onSubscribe($conn, $topic);
    }

    /**
     * 
     * @param ConnectionInterface $conn
     * @param type $topic
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        $this->dispatch($topic)->onUnSubscribe($conn, $topic);
    }

    /**
     * 
     * @param InternalMessage $message
     */
    public function onInternalMessage(Event $event) {
        $this->dispatch($event->getTopic())->onInternalMessage($event);
    }

}
