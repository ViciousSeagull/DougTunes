<?php

declare(strict_types=1);

session_start();

date_default_timezone_set('UTC');

require_once __DIR__ . '/../config/secrets.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/response.php';

$dt_db = dt_db();
