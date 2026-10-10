<?php

ob_start();
require_once __DIR__ . '/search.php';
$searchResults = ob_get_clean();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fika Indigene Records</title>
    <link rel="stylesheet" type="text/css" href="css_fika.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div id="wrapper">
        <?php require __DIR__ . '/header_fika.php'; ?>
        <main id="new_div">
            <aside id="left_side">
                <p>Welcome to the online indigene record portal for Fika Local Government, Yobe State.</p>
                <p><a href="add_fika.php">Register a citizen</a> or search existing records by name.</p>
            </aside>
            <?php echo $searchResults; ?>
        </main>
        <footer id="fooo">Copyright &copy; 2014 Fika Local Government</footer>
    </div>
</body>
</html>
