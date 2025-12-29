<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$state = dt_state_get();

function dt_state_bucket(?string $lastSeen): string
{
    if (!$lastSeen) {
        return 'OFFLINE';
    }
    $last = strtotime($lastSeen . ' UTC');
    $age = time() - $last;
    if ($age > 300) {
        return 'OFFLINE';
    }
    if ($age > 120) {
        return 'STALE';
    }
    return 'ONLINE';
}

$hostState = dt_state_bucket($state['host_last_seen_utc'] ?? null);
$agentState = dt_state_bucket($state['agent_last_seen_utc'] ?? null);

if ($hostState === 'OFFLINE') {
    if ((int) ($state['requests_open'] ?? 1) !== 0 || ($state['requests_open_reason'] ?? '') !== 'HOST_OFFLINE') {
        dt_state_update([
            'requests_open' => 0,
            'requests_open_reason' => 'HOST_OFFLINE',
        ]);
        $state = dt_state_get();
    }
} else {
    if (($state['requests_open_reason'] ?? null) === 'HOST_OFFLINE') {
        dt_state_update([
            'requests_open' => 1,
            'requests_open_reason' => null,
        ]);
        $state = dt_state_get();
    }
}

dt_json([
    'state' => $state,
    'host_state' => $hostState,
    'agent_state' => $agentState,
]);
