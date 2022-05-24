<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

abstract class AbstractLogger implements LoggerInterface
{
    abstract protected function log(string $message): void;

    public function err(string $message): void
    {
        $this->log('[ERR]' . $message);
    }

    public function warn(string $message): void
    {
        $this->log('[WARN]' . $message);
    }

    public function info(string $message): void
    {
        $this->log('[INFO]' . $message);
    }
}
