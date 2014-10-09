<?php

return array(
    'router' => array(
        "routes" => array(
            'home_admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/gamehub/admin[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrateur\Controller',
                        'controller' => 'index',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                "child_routes" => array(
                    "home_connected_region_detail" => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:idregion]',
                            'constraints' => array(
                                'controller' => 'region',
                                'action' => 'detail',
                                'idregion' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Administrateur\Controller',
                                'controller' => 'region',
                                'action' => 'detail'
                            ),
                        ),
                    ),
                ),
            ),
        ),
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
            'Administrateur\Controller\Index' => 'Administrateur\Controller\IndexController',
            'Administrateur\Controller\Region' => 'Administrateur\Controller\RegionController',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'administrateur_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array ',
                'paths' => array(__DIR__ . '/../src/Administrateur/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Administrateur\Entity' => 'administrateur_entities'
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout_gamehub' => __DIR__ . '/../view/layout/layout_gamehub.phtml',
            'layout/layout_login' => __DIR__ . '/../view/layout/layout_login.phtml',
            'layout/layout_gamehub_part_inbox' => __DIR__ . '/../view/layout/part/part_gamehub_inbox.phtml',
            'layout/layout_gamehub_part_menuleft' => __DIR__ . '/../view/layout/part/part_gamehub_menuleft.phtml',
            'layout/layout_gamehub_part_notification' => __DIR__ . '/../view/layout/part/part_gamehub_notification.phtml',
            'layout/layout_gamehub_part_notification_modo' => __DIR__ . '/../view/layout/part/part_gamehub_notification_modo.phtml',
            'layout/layout_gamehub_part_todo' => __DIR__ . '/../view/layout/part/part_gamehub_todo.phtml',
            'layout/layout_gamehub_part_user' => __DIR__ . '/../view/layout/part/part_gamehub_user.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
