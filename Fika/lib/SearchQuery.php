<?php

namespace OnlineIndegene;

final class SearchQuery
{
    public static function forTerm(string $term): array
    {
        $pattern = '%' . $term . '%';

        return [
            'sql' => 'SELECT * FROM `fika_admin` WHERE `first_name` LIKE ? OR `last_name` LIKE ?',
            'parameters' => [$pattern, $pattern],
        ];
    }
}
