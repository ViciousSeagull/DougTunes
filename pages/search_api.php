<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$query = trim((string) ($_GET['q'] ?? ''));

if ($query === '') {
    dt_json(['results' => []]);
}

$stmt = dt_db()->prepare('SELECT * FROM dt_library WHERE song_title LIKE :q OR artist LIKE :q OR album LIKE :q LIMIT 50');
$stmt->execute([':q' => '%' . $query . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

dt_json(['results' => $results]);
