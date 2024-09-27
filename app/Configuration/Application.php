<?php

namespace App\Configuration;

use SlimFramework\Configuration\ConfigurationInterface;

class Application implements ConfigurationInterface
{

    /**
     * @inheritDoc
     */
    public function configure(): array
    {
        return require_once (SLIM_APPLICATION_ROOT_PATH . '/config/application.php');

    }
}