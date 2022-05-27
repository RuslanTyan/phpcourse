<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

class StaticLoggerFactory extends LoggerFactory
{
    protected array $config;

    public function __construct()
    {
        $this->config = require './config.php';
        parent::__construct($this->config);
    }
}
