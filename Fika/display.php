<?php

require_once __DIR__ . '/myconnection.php';

$selectQuery = 'SELECT `images_path` FROM `images_tbl`';
$result = $mysqli->query($selectQuery);

if ($result === false) {
    http_response_code(500);
    exit('Unable to load uploaded images.');
}

while ($row = $result->fetch_assoc()) {
    ?>
    <table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo htmlspecialchars($row['images_path'], ENT_QUOTES, 'UTF-8'); ?>" width="100" height="200" align="right" alt="Uploaded image">
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

