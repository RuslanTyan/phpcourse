<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

abstract class AbstractLogger implements LoggerInterface
{
    abstract protected function log(string $message): void;

    protected const LEVEL_ERR = 0;
    protected const LEVEL_WARN = 1;
    protected const LEVEL_INFO = 2;

    protected int $log_level = self::LEVEL_ERR;

    public function setLogLevel(int $level): self
    {
        $this->log_level = $level;
        return $this;
    }

    public function err(string $message): void
    {
        if ($this->log_level >= self::LEVEL_ERR) {
            $this->log('[ERR] ' . $message);
        }
    }

    public function warn(string $message): void
    {
        if ($this->log_level >= self::LEVEL_WARN) {
            $this->log('[WARN] ' . $message);
        }
    }

    public function info(string $message): void
    {
        if ($this->log_level >= self::LEVEL_INFO) {
            $this->log('[INFO] ' . $message);
        }
    }
}
