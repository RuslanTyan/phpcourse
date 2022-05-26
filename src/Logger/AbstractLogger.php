<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

abstract class AbstractLogger implements LoggerInterface
{
    abstract protected function log(string $message): void;

    private const LEVEL_INFO = 0;
    private const LEVEL_WARN = 1;
    private const LEVEL_ERR = 2;

    protected int $log_level = 0;

    public function setLogLevel(int $level): self
    {
        $this->log_level = $level;
        return $this;
    }

    public function err(string $message): void
    {
        if ($this->log_level > self::LEVEL_ERR) {
            return;
        }
        $this->log('[ERR] ' . $message);
    }

    public function warn(string $message): void
    {
        if ($this->log_level > self::LEVEL_WARN) {
            return;
        }
        $this->log('[WARN] ' . $message);
    }

    public function info(string $message): void
    {
        if ($this->log_level > self::LEVEL_INFO) {
            return;
        }
        $this->log('[INFO] ' . $message);
    }
}
