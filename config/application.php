<?php

use PHPMailer\PHPMailer\SMTP;

$configuration['application'] = [
    'timezone' => 'America/Sao_Paulo',
    'path' => [
        'tests' => SLIM_APPLICATION_ROOT_PATH . '/tests',
        'public' => SLIM_APPLICATION_ROOT_PATH . '/public',
        'assets' => 'assets/',
        'config' => SLIM_APPLICATION_ROOT_PATH . '/config',
        'data' => SLIM_APPLICATION_ROOT_PATH . '/data',
        'storage' => SLIM_APPLICATION_ROOT_PATH . '/storage',
        'cache' => SLIM_APPLICATION_ROOT_PATH . '/storage/cache',
        'console' => SLIM_APPLICATION_ROOT_PATH . '/app/Console',
        'migration' => SLIM_APPLICATION_ROOT_PATH . '/app/Migration',
        'seeder' => SLIM_APPLICATION_ROOT_PATH . '/app/Seeder',
        'provider' => SLIM_APPLICATION_ROOT_PATH . '/app/Provider',
        'repository' => SLIM_APPLICATION_ROOT_PATH . '/app/Repository',
        'entity' => SLIM_APPLICATION_ROOT_PATH . '/app/Entity',
        'files' => [
            'images' => SLIM_APPLICATION_ROOT_PATH . '/storage/images'
        ]
    ],
    'view' => [
        'path' => SLIM_APPLICATION_ROOT_PATH . '/resources/views',

        'templates' => [
            'api' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/api',
            'console' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/console',
            'email' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/email',
            'error' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/error',
            'layout' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/layout',
            'site' => SLIM_APPLICATION_ROOT_PATH . '/resources/views/site',
        ],

        'settings' => [
            'cache' => SLIM_APPLICATION_ROOT_PATH . '/storage/cache/views',
            'debug' => true,
            'auto_reload' => true,
        ],

        'assets' => [
            // Public assets cache directory
            'path' => SLIM_APPLICATION_ROOT_PATH . '/public/assets',

            // Public url base path
            'url_base_path' => SLIM_APPLICATION_ROOT_PATH . '/public/assets',

            // Internal cache directory for the assets
            'cache_path' => SLIM_APPLICATION_ROOT_PATH . '/storage/cache/views',

            'cache_name' => 'assets-cache',

            //  Should be set to 1 (enabled) in production
            'minify' => 1,
        ]
    ],
    'system' => [
        'maintenance' => 0,
        'maintenance_return' => '2023-07-16 12:07',
        'maintenance_route' => '/maintenance',
        'guest_routes' => [
            '/login',
        ],
        'routes_in_maintenance' => [
        ],
    ],
    'mailer' => [
        //PHPMailer settings
        'phpmailer' => [
            //Configs
            'smtp_host' => 'smtp.example.com',
            'smtp_debug' => SMTP::DEBUG_OFF,
            'smtp_exceptions' => false,

            'smtp_port' => 465,
            'smtp_options' => [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ],

            // Auth
            'username' => 'youremail@gmail.com',
            'password' => 'yourpasswordemail',
        ]
    ],
    'error' => [
        'slashtrace' => 1, // Exibir erros na tela
        'error_reporting' => 1,
        'display_errors' => 1,
        'display_startup_errors' => 1,
    ]
];

$configuration['application']['file'] = [
    'database' => $configuration['application']['path']['config'] . '/database.php',
    'oauth_private' => $configuration['application']['path']['data'] . '/oauth/keys/private.key',
    'oauth_public' => $configuration['application']['path']['data'] . '/oauth/keys/public.key',
];

return $configuration;