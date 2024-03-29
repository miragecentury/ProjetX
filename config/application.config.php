<?php

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Api',
        'Administrateur',
        'Moderateur',
        'Utilisateur',
        'Application',
    ),
    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => array(
            './module',
            './vendor',
        ),
        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    // Whether or not to enable a configuration cache.
    // If enabled, the merged configuration will be cached and used in
    // subsequent requests.
    //'config_cache_enabled' => $booleanValue,
    // The key used to create the configuration cache file name.
    //'config_cache_key' => $stringKey,
    // Whether or not to enable a module class map cache.
    // If enabled, creates a module class map cache which will be used
    // by in future requests, to reduce the autoloading process.
    //'module_map_cache_enabled' => $booleanValue,
    // The key used to create the class map cache file name.
    //'module_map_cache_key' => $stringKey,
    // The path in which to cache merged configuration.
    //'cache_dir' => $stringPath,
    // Whether or not to enable modules dependency checking.
    // Enabled by default, prevents usage of modules that depend on other modules
    // that weren't loaded.
    // 'check_dependencies' => true,
    ),
    // Used to create an own service manager. May contain one or more child arrays.
    //'service_listener_options' => array(
    //     array(
    //         'service_manager' => $stringServiceManagerName,
    //         'config_key'      => $stringConfigKey,
    //         'interface'       => $stringOptionalInterface,
    //         'method'          => $stringRequiredMethodName,
    //     ),
    // )
    // Initial configuration with which to seed the ServiceManager.
    // Should be compatible with Zend\ServiceManager\Config.
    // 'service_manager' => array(),
    'service_manager' => array(
        'factories' => array(
            "Zend\Session\SessionManager" => "BPC\Session\SessionManagerFactory",
            "Zend\Authentication\AuthenticationService" => "BPC\Authentication\AuthenticationServiceFactory",
            'Zend\Mail\Transport' => function ($serviceManager) {
                $config = $serviceManager->get('Config');
                $transport = new Smtp();
                $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                return $transport;
            },
        ),
        'invokables' => array(
            //--Mapper:
            "A3\Common\Mapper\User" => "A3\Common\Mapper\UserMapper",
            "A3\Common\Mapper\Grade" => "A3\Common\Mapper\GradeMapper",
            "A3\Common\Mapper\Side" => "A3\Common\Mapper\SideMapper",
            "A3\Common\Mapper\Personnage" => "A3\Common\Mapper\PersonnageMapper",
            //
            "A3\Region\Mapper\Island" => "A3\Region\Mapper\IslandMapper",
            //--Service:
            "A3\Common\Service\User" => "A3\Common\Service\UserService",
            "A3\Common\Service\Grade" => "A3\Common\Service\GradeService",
            "A3\Common\Service\Side" => "A3\Common\Service\SideService",
            "A3\Common\Service\Personnage" => "A3\Common\Service\PersonnageService",
            //
            "A3\Region\Service\Island" => "A3\Region\Service\IslandService",
        ),
        'aliases' => array(
        ),
    ),
    'session' => array(
        'remember_me_seconds' => 2419200,
        'use_cookies' => true,
        'cookie_httponly' => true,
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'projetx',
            ),
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'ControllerName' => 'BPC\View\Helper\ControllerName',
            'ActionName' => 'BPC\View\Helper\ActionName',
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            //'text_domain' => __NAMESPACE__,
            ),
        ),
    ),
    'my_wamp_security' => array(
        "roles" => array(
            "anonymous",
            "utilisateur",
            "moderateur",
            "administrateur",
        ),
        "topics" => array(
            "ws.projetx" => array(
                "call" => array("administrateur"),
                "suscribe" => array("administrateur"),
                "publish" => array("administrateur"),
                "childs" => array(
                    "common" => array(
                        "call" => array("administrateur"),
                        "suscribe" => array("administrateur"),
                        "publish" => array("administrateur"),
                        "childs" => array(
                            "user" => array(
                                "call" => array("administrateur"),
                                "suscribe" => array("administrateur"),
                                "publish" => array("administrateur"),
                                "childs" => array(
                                    "login" => array(
                                        "call" => array("anonymous"),
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    "system" => array(
                        "call" => array("administrateur"),
                        "suscribe" => array("administrateur"),
                        "publish" => array("administrateur"),
                        "childs" => array(
                            "log" => array(
                                "call" => array("administrateur"),
                                "suscribe" => array("administrateur"),
                                "publish" => array("administrateur"),
                                "childs" => array(
                                    "debug" => array(
                                        "call" => array("administrateur"),
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                    "info" => array(
                                        "call" => null,
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                    "warning" => array(
                                        "call" => null,
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                    "error" => array(
                                        "call" => null,
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                    "critical" => array(
                                        "call" => null,
                                        "suscribe" => array("administrateur"),
                                        "publish" => array("administrateur"),
                                    ),
                                ),
                            ),
                            "ping" => array(
                                "call" => null,
                                "suscribe" => array("public"),
                                "publish" => array("public"),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
