<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

class StdoutLogger extends AbstractLogger
{
    protected function log(string $message): void
    {
        echo $message . PHP_EOL;
    }
}
