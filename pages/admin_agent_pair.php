<?php
require_once __DIR__ . '/../lib/bootstrap.php';
dt_require_admin();

$agentKey = dt_setting_get('AGENT_TICK_KEY');
$revealed = isset($_GET['reveal']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agentKey = bin2hex(random_bytes(24));
    dt_setting_set('AGENT_TICK_KEY', $agentKey);
    header('Location: admin_agent_pair.php?reveal=1');
    exit;
}

$masked = $agentKey ? str_repeat('•', max(0, strlen($agentKey) - 4)) . substr($agentKey, -4) : 'Not paired';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pair Agent</title>
</head>
<body>
    <h1>Pair Agent</h1>
    <p>Agent key: <strong><?php echo htmlspecialchars($revealed ? (string) $agentKey : $masked); ?></strong></p>
    <?php if ($agentKey && !$revealed): ?>
        <p><a href="admin_agent_pair.php?reveal=1">Reveal Key</a></p>
    <?php endif; ?>
    <form method="post">
        <button type="submit">Generate New Agent Key</button>
    </form>
    <p>Save this key to the agent_key.txt file for the scheduled task.</p>
    <p><a href="admin_setup.php">Back to setup</a></p>
</body>
</html>
