<?php

namespace App\Configuration;

use SlimFramework\Configuration\ConfigurationInterface;
use PHPMailer\PHPMailer\SMTP;


class Application implements ConfigurationInterface
{

    /**
     * @inheritDoc
     */
    public function configure(): array
    {
        $configuration['application'] = [
            'timezone' => 'America/Sao_Paulo',
            'path' => [
                'tests' => $this->applicationPath() . '/tests',
                'public' => $this->applicationPath() . '/public',
                'assets' => 'assets/',
                'config' => $this->applicationPath() . '/config',
                'data' => $this->applicationPath() . '/data',
                'storage' => $this->applicationPath() . '/storage',
                'cache' => $this->applicationPath() . '/storage/cache',
                'console' => $this->applicationPath() . '/app/Console',
                'migration' => $this->applicationPath() . '/app/Migration',
                'seeder' => $this->applicationPath() . '/app/Seeder',
                'provider' => $this->applicationPath() . '/app/Provider',
                'repository' => $this->applicationPath() . '/app/Repository',
                'entity' => $this->applicationPath() . '/app/Entity',
                'files' => [
                    'images' => $this->applicationPath() . '/storage/images'
                ]
            ],
            'view' => [
                'path' => $this->applicationPath() . '/resources/views',

                'templates' => [
                    'api' => $this->applicationPath() . '/resources/views/api',
                    'console' => $this->applicationPath() . '/resources/views/console',
                    'email' => $this->applicationPath() . '/resources/views/email',
                    'error' => $this->applicationPath() . '/resources/views/error',
                    'layout' => $this->applicationPath() . '/resources/views/layout',
                    'site' => $this->applicationPath() . '/resources/views/site',
                ],

                'settings' => [
                    'cache' => $this->applicationPath() . '/storage/cache/views',
                    'debug' => true,
                    'auto_reload' => true,
                ],

                'assets' => [
                    // Public assets cache directory
                    'path' => $this->applicationPath() . '/public/assets',

                    // Public url base path
                    'url_base_path' => $this->applicationPath() . '/public/assets',

                    // Internal cache directory for the assets
                    'cache_path' => $this->applicationPath() . '/storage/cache/views',

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
    }

    /**
     * @return string
     */
    private function applicationPath(): string
    {
        return SLIM_APPLICATION_ROOT_PATH;
    }
}