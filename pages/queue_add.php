<?php
require_once __DIR__ . '/../lib/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $song = trim((string) ($_POST['song_title'] ?? ''));
    $user = trim((string) ($_POST['requested_by'] ?? ''));
    if ($song !== '') {
        $stmt = dt_db()->prepare('INSERT INTO dt_queue (song_title, requested_by, votes, created_utc) VALUES (:song, :user, 0, :created)');
        $stmt->execute([
            ':song' => $song,
            ':user' => $user,
            ':created' => dt_now_utc(),
        ]);
        header('Location: queue.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Request Song</title>
</head>
<body>
    <h1>Request a Song</h1>
    <form method="post">
        <label>
            Song title:
            <input type="text" name="song_title" required>
        </label>
        <br>
        <label>
            Your name:
            <input type="text" name="requested_by">
        </label>
        <br>
        <button type="submit">Add to Queue</button>
    </form>
</body>
</html>
