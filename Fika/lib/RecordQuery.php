<?php

namespace OnlineIndegene;

final class RecordQuery
{
    public static function insertSql(): string
    {
        return 'INSERT INTO `fika_admin` (`first_name`, `last_name`, `phone_number`, `home_town`, `contact_address`, '
            . '`email`, `gender`, `image`, `submission_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    }
}
