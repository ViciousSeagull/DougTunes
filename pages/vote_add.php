<?php
require_once __DIR__ . '/../lib/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed.';
    exit;
}

$queueId = (int) ($_POST['queue_id'] ?? 0);
if ($queueId <= 0) {
    http_response_code(400);
    echo 'Invalid queue item.';
    exit;
}

$stmt = dt_db()->prepare('UPDATE dt_queue SET votes = votes + 1 WHERE id = :id');
$stmt->execute([':id' => $queueId]);

header('Location: queue.php');
exit;
