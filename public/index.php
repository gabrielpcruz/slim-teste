<?php

use SlimFramework\Slim;

require __DIR__ . '/../vendor/autoload.php';

$app = Slim::bootstrap();

$app->run();