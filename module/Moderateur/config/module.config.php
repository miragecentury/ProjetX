<?php

return array(
    'router' => array(
    ),
    'service_manager' => array(
        'factories' => array(
        ),
        'invokables' => array(
        //--Mapper:
        //--Service:
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'moderateur_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array ',
                'paths' => array(__DIR__ . '/../src/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Moderateur\Entity' => 'moderateur_entities'
                ),
            ),
        ),
    ),
);
