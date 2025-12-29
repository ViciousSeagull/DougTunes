<?php
require_once __DIR__ . '/../lib/bootstrap.php';
dt_require_admin();

$state = dt_state_get();
$frequency = (int) dt_setting_get('COMMERCIAL_FREQUENCY_SONGS', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enabled = isset($_POST['commercials_enabled']) ? 1 : 0;
    $nextAfter = max(0, (int) ($_POST['commercial_frequency'] ?? 0));
    dt_setting_set('COMMERCIAL_FREQUENCY_SONGS', (string) $nextAfter);
    dt_state_update([
        'commercials_enabled' => $enabled,
        'next_commercial_after' => $nextAfter,
    ]);
    header('Location: admin_setup.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DougTunes Admin Setup</title>
</head>
<body>
    <h1>DougTunes Admin Setup</h1>
    <ol>
        <li><a href="admin_host_pair.php">Pair Host</a></li>
        <li><a href="admin_agent_pair.php">Pair Agent</a></li>
        <li><a href="status.php">View Status</a></li>
    </ol>

    <h2>Commercial Settings</h2>
    <form method="post">
        <label>
            <input type="checkbox" name="commercials_enabled" value="1" <?php echo ($state['commercials_enabled'] ?? 0) ? 'checked' : ''; ?>>
            Enable commercials
        </label>
        <br>
        <label>
            Songs between commercials:
            <input type="number" min="0" name="commercial_frequency" value="<?php echo htmlspecialchars((string) $frequency); ?>">
        </label>
        <br>
        <button type="submit">Save Settings</button>
    </form>
</body>
</html>
