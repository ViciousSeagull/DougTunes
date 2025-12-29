<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$queue = dt_db()->query('SELECT * FROM dt_queue ORDER BY votes DESC, created_utc ASC')->fetchAll(PDO::FETCH_ASSOC);
$state = dt_state_get();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DougTunes Host</title>
</head>
<body>
    <h1>DougTunes Host View</h1>
    <p>Commercials enabled: <?php echo ($state['commercials_enabled'] ?? 0) ? 'Yes' : 'No'; ?></p>
    <h2>Queue</h2>
    <ul>
        <?php foreach ($queue as $item): ?>
            <li><?php echo htmlspecialchars($item['song_title']); ?> (<?php echo (int) $item['votes']; ?> votes)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
