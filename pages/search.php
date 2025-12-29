<?php
require_once __DIR__ . '/../lib/bootstrap.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search DougTunes</title>
</head>
<body>
    <h1>Search DougTunes</h1>
    <form method="get" action="search_api.php">
        <input type="text" name="q" placeholder="Search songs">
        <button type="submit">Search</button>
    </form>
</body>
</html>
