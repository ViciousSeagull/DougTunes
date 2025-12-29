<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$queue = dt_db()->query('SELECT * FROM dt_queue ORDER BY votes DESC, created_utc ASC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DougTunes Queue</title>
</head>
<body>
    <h1>Queue</h1>
    <ul>
        <?php foreach ($queue as $item): ?>
            <li>
                <?php echo htmlspecialchars($item['song_title']); ?>
                (<?php echo (int) $item['votes']; ?> votes)
                <form method="post" action="vote_add.php" style="display:inline;">
                    <input type="hidden" name="queue_id" value="<?php echo (int) $item['id']; ?>">
                    <button type="submit">Vote</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="queue_add.php">Request a song</a></p>
</body>
</html>
