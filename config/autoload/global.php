<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    'mail' => array(
        'transport' => array(
            'options' => array(
                'host' => 'smtp.gmail.com',
                'connection_class' => 'plain',
                'connection_config' => array(
                    'username' => 'sender@nordri.fr',
                    'password' => '',
                    'ssl' => 'tls'
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'username' => 'root',
                    'password' => '',
                    'dbname' => 'dev_a3',
                ),
            ),
        ),
        'driver' => array(
            'a3_common_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array ',
                'paths' => array(__DIR__ . '/../../vendor/A3/src/Common/Entity')
            ),
            'a3_region_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array ',
                'paths' => array(__DIR__ . '/../../vendor/A3/src/Region/Entity')
            ),
            'a3_communication_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array ',
                'paths' => array(__DIR__ . '/../../vendor/A3/src/Communication/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'A3\Common\Entity' => 'a3_common_entities',
                    'A3\Region\Entity' => 'a3_region_entities',
                    'A3\Communication\Entity' => 'a3_communication_entities'
                ),
            ),
        ),
    ),
);
