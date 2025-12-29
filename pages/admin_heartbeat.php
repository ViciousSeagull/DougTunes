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

dt_json(['status' => 'ok', 'host_last_seen_utc' => dt_state_get()['host_last_seen_utc']]);
