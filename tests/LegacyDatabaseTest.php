<?php

namespace OnlineIndegene\Tests;

use PHPUnit\Framework\TestCase;

final class LegacyDatabaseTest extends TestCase
{
    public function testLegacyPagesNoLongerUseDeprecatedMysqlFunctions(): void
    {
        $files = [
            __DIR__ . '/../Fika/display.php',
            __DIR__ . '/../Fika/file_display.php',
            __DIR__ . '/../Fika/myconnection.php',
        ];

        foreach ($files as $file) {
            $contents = file_get_contents($file);

            $this->assertNotFalse($contents, sprintf('Unable to read %s.', $file));
            $this->assertStringNotContainsString('mysql_', $contents);
            $this->assertStringNotContainsString('mysql_query', $contents);
            $this->assertStringNotContainsString('mysql_error', $contents);
        }
    }
}
