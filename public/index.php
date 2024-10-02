<?php

use SlimFramework\Slim;

require __DIR__ . '/../vendor/autoload.php';

define('SLIM_APPLICATION_ROOT_PATH',  str_replace('/public', '', __DIR__));

$app = Slim::bootstrap();

$app->run();