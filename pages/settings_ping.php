<?php
require_once __DIR__ . '/../lib/bootstrap.php';

$state = dt_state_get();
$settings = [
    'commercial_frequency_songs' => (int) dt_setting_get('COMMERCIAL_FREQUENCY_SONGS', 0),
];

dt_json([
    'state' => $state,
    'settings' => $settings,
]);
