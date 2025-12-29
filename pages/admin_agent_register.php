<?php
require_once __DIR__ . '/../lib/bootstrap.php';
dt_require_admin();

$agentKey = dt_setting_get('AGENT_TICK_KEY');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agent Registration</title>
</head>
<body>
    <h1>Agent Registration</h1>
    <p>Place the agent key in the local agent_key.txt file and configure the scheduled task to send it as X-DT-KEY.</p>
    <p>Current agent key: <strong><?php echo htmlspecialchars($agentKey ? $agentKey : 'Not paired'); ?></strong></p>
    <p><a href="admin_agent_pair.php">Pair Agent</a></p>
</body>
</html>
