<?php

declare(strict_types=1);

error_reporting(0);

require __DIR__ . '/vendor/autoload.php';

use PhpCourse\App;

$config = require './config.php';
$logger = (new PhpCourse\Logger\LoggerFactory($config))->getLogger();

$myapp = new App($logger);
$logger->info("Start app");
$myapp->run();
$logger->info("End app");
