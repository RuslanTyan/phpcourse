<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

class LoggerFactory
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getLogger(): LoggerInterface
    {
        if ($this->config["logger"] === 'stdout') {
            return (new StdoutLogger())->setLogLevel($this->config["log_level"]);
        }

        if ($this->config["logger"] === 'file') {
            return (new FileLogger($this->config["filename"]))->setLogLevel($this->config["log_level"]);
        }

        throw new \Exception("Cannot create logger");
    }
}
