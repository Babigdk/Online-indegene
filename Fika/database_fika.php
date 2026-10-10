<?php

use OnlineIndegene\DatabaseConfig;
use OnlineIndegene\Logger;

require_once __DIR__ . '/lib/Logger.php';
require_once __DIR__ . '/lib/DatabaseConfig.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $config = DatabaseConfig::connectionOptions();
    $mysqli = new mysqli(
        $config['host'],
        $config['user'],
        $config['password'],
        $config['database']
    );
    $mysqli->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    Logger::error('Database connection failed', $exception);
    http_response_code(500);
    exit('The service is temporarily unavailable. Please try again later.');
}
