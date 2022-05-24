<?php

declare(strict_types=1);

namespace PhpCourse\Logger;

class FileLogger extends AbstractLogger
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    protected function log(string $message): void
    {
        file_put_contents($this->file, $message . PHP_EOL, FILE_APPEND);
    }
}
