<?php
require_once __DIR__ . '/../lib/bootstrap.php';
dt_require_admin();

$hostKey = dt_setting_get('HOST_TICK_KEY');
$revealed = isset($_GET['reveal']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hostKey = bin2hex(random_bytes(24));
    dt_setting_set('HOST_TICK_KEY', $hostKey);
    header('Location: admin_host_pair.php?reveal=1');
    exit;
}

$masked = $hostKey ? str_repeat('•', max(0, strlen($hostKey) - 4)) . substr($hostKey, -4) : 'Not paired';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pair Host</title>
</head>
<body>
    <h1>Pair Host</h1>
    <p>Host key: <strong><?php echo htmlspecialchars($revealed ? (string) $hostKey : $masked); ?></strong></p>
    <?php if ($hostKey && !$revealed): ?>
        <p><a href="admin_host_pair.php?reveal=1">Reveal Key</a></p>
    <?php endif; ?>
    <form method="post">
        <button type="submit">Generate New Host Key</button>
    </form>
    <p>Save this key to the host_key.txt file on the host machine.</p>
    <p><a href="admin_setup.php">Back to setup</a></p>
</body>
</html>
