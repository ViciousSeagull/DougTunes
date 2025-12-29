<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$agentKey = (string) dt_setting_get('AGENT_TICK_KEY', '');
if ($agentKey === '') {
    http_response_code(500);
    echo 'Agent key not configured.';
    exit;
}

dt_require_key($agentKey);

dt_state_update([
    'agent_last_seen_utc' => dt_now_utc(),
]);

dt_json(['status' => 'ok', 'agent_last_seen_utc' => dt_state_get()['agent_last_seen_utc']]);
