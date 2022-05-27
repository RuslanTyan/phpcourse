<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

interface LoggerInterface
{
    public function err(string $message): void;

    public function warn(string $message): void;

    public function info(string $message): void;
}
