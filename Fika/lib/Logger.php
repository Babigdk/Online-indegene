<?php

namespace OnlineIndegene;

final class Logger
{
    public static function error(string $message, Throwable $exception): void
    {
        error_log(sprintf('%s: %s', $message, $exception->getMessage()));
    }
}
