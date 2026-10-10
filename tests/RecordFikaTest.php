<?php

namespace OnlineIndegene\Tests;

use PHPUnit\Framework\TestCase;
use OnlineIndegene\RecordQuery;

final class RecordFikaTest extends TestCase
{
    public function testInsertQueryHasFixedColumnsAndOnePlaceholderPerValue(): void
    {
        $query = RecordQuery::insertSql();

        $this->assertSame(
            'INSERT INTO `fika_admin` (`first_name`, `last_name`, `phone_number`, `home_town`, `contact_address`, '
                . '`email`, `gender`, `image`, `submission_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            $query
        );
        $this->assertSame(9, substr_count($query, '?'));
    }
}
