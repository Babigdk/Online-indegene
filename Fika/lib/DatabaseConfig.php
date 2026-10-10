<?php

namespace OnlineIndegene;

final class DatabaseConfig
{
    public static function connectionOptions(): array
    {
        return [
            'host' => self::environmentValue('DB_HOST', 'localhost'),
            'user' => self::environmentValue('DB_USER', 'root'),
            'password' => self::environmentValue('DB_PASS', ''),
            'database' => self::environmentValue('DB_NAME', 'fika'),
        ];
    }

    private static function environmentValue(string $name, string $default): string
    {
        $value = getenv($name);

        return $value === false ? $default : $value;
    }
}
