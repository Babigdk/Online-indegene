<?php

namespace OnlineIndegene\Tests;

use PHPUnit\Framework\TestCase;
use OnlineIndegene\SearchQuery;

final class SearchTest extends TestCase
{
    public function testSearchUsesFixedPreparedStatementAndSeparateParameters(): void
    {
        $query = SearchQuery::forTerm("'; DROP TABLE fika_admin;--");

        $this->assertSame(
            'SELECT * FROM `fika_admin` WHERE `first_name` LIKE ? OR `last_name` LIKE ?',
            $query['sql']
        );
        $this->assertSame(
            ["%'; DROP TABLE fika_admin;--%", "%'; DROP TABLE fika_admin;--%"],
            $query['parameters']
        );
        $this->assertStringNotContainsString('DROP TABLE', $query['sql']);
    }

    public function testSearchAddsWildcardsToBothNameParameters(): void
    {
        $query = SearchQuery::forTerm('Fika');

        $this->assertSame(['%Fika%', '%Fika%'], $query['parameters']);
    }
}
