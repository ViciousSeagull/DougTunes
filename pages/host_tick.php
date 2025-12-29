<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$hostKey = (string) dt_setting_get('HOST_TICK_KEY', '');
if ($hostKey === '') {
    http_response_code(500);
    echo 'Host key not configured.';
    exit;
}

dt_require_key($hostKey);

dt_state_update([
    'host_last_seen_utc' => dt_now_utc(),
]);

$queue = dt_db()->query('SELECT * FROM dt_queue ORDER BY votes DESC, created_utc ASC')->fetchAll(PDO::FETCH_ASSOC);
$state = dt_state_get();
$settings = [
    'commercial_frequency_songs' => (int) dt_setting_get('COMMERCIAL_FREQUENCY_SONGS', 0),
];

dt_json([
    'status' => 'ok',
    'queue' => $queue,
    'state' => $state,
    'settings' => $settings,
]);
