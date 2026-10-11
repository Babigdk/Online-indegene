<?php

use OnlineIndegene\Logger;

require_once __DIR__ . '/database_fika.php';
require_once __DIR__ . '/lib/Logger.php';

function getImageExtension(string $imagetype): string|false
{
    $extensions = [
        'image/bmp' => '.bmp',
        'image/gif' => '.gif',
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
    ];

    return $extensions[$imagetype] ?? false;
}

if (empty($_FILES['uploadedimage']['name'])) {
    exit('No image was selected for upload.');
}

$tempName = $_FILES['uploadedimage']['tmp_name'] ?? '';
$imageType = $_FILES['uploadedimage']['type'] ?? '';
$extension = getImageExtension($imageType);

if ($extension === false) {
    exit('Please upload a BMP, GIF, JPEG, or PNG image.');
}

$imageName = date('d-m-Y') . '-' . time() . $extension;
$targetPath = 'images/' . $imageName;
$targetFile = __DIR__ . '/' . $targetPath;

if (!move_uploaded_file($tempName, $targetFile)) {
    exit('Error while uploading image on the server');
}

try {
    $statement = $mysqli->prepare('INSERT INTO `images_tbl` (`images_path`, `submission_date`) VALUES (?, ?)');
    $submissionDate = date('Y-m-d');
    $statement->bind_param('ss', $targetPath, $submissionDate);
    $statement->execute();
    $statement->close();

    echo 'photo uploaded successfully';
} catch (mysqli_sql_exception $exception) {
    if (is_file($targetFile)) {
        unlink($targetFile);
    }

    Logger::error('Image upload failed', $exception);
    http_response_code(500);
    exit('The image could not be saved. Please try again later.');
}

