<?php

namespace OnlineIndegene\Tests;

use OnlineIndegene\DatabaseConfig;
use PHPUnit\Framework\TestCase;

final class DatabaseFikaTest extends TestCase
{
    private array $originalEnvironment = [];

    protected function setUp(): void
    {
        foreach (['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME'] as $key) {
            $this->originalEnvironment[$key] = getenv($key);
            putenv($key);
        }
    }

    protected function tearDown(): void
    {
        foreach ($this->originalEnvironment as $key => $value) {
            putenv($value === false ? $key : "{$key}={$value}");
        }
    }

    public function testUsesLocalDevelopmentDefaultsWhenEnvironmentIsUnset(): void
    {
        $this->assertSame(
            [
                'host' => 'localhost',
                'user' => 'root',
                'password' => '',
                'database' => 'fika',
            ],
            DatabaseConfig::connectionOptions()
        );
    }

    public function testReadsDatabaseSettingsFromEnvironment(): void
    {
        putenv('DB_HOST=db');
        putenv('DB_USER=fika_app');
        putenv('DB_PASS=local-test-password');
        putenv('DB_NAME=fika_test');

        $this->assertSame(
            [
                'host' => 'db',
                'user' => 'fika_app',
                'password' => 'local-test-password',
                'database' => 'fika_test',
            ],
            DatabaseConfig::connectionOptions()
        );
    }

    public function testPreservesExplicitlyEmptyPassword(): void
    {
        putenv('DB_PASS=');

        $this->assertSame('', DatabaseConfig::connectionOptions()['password']);
    }
}
