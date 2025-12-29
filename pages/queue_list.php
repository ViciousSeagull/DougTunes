<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$queue = dt_db()->query('SELECT * FROM dt_queue ORDER BY votes DESC, created_utc ASC')->fetchAll(PDO::FETCH_ASSOC);

dt_json(['queue' => $queue]);
