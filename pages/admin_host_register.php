<?php
require_once __DIR__ . '/../lib/bootstrap.php';
dt_require_admin();

$hostKey = dt_setting_get('HOST_TICK_KEY');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Host Registration</title>
</head>
<body>
    <h1>Host Registration</h1>
    <p>Place the host key in the local host_key.txt file and configure the scheduled task to send it as X-DT-KEY.</p>
    <p>Current host key: <strong><?php echo htmlspecialchars($hostKey ? $hostKey : 'Not paired'); ?></strong></p>
    <p><a href="admin_host_pair.php">Pair Host</a></p>
</body>
</html>
