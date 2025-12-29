<?php

declare(strict_types=1);

function dt_db(): PDO
{
    static $pdo;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dbPath = DT_DB_PATH;
    $needsInit = !file_exists($dbPath);

    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($needsInit) {
        $schema = file_get_contents(__DIR__ . '/../db/schema.sql');
        $seed = file_get_contents(__DIR__ . '/../db/seed.sql');
        if ($schema === false || $seed === false) {
            throw new RuntimeException('Missing schema or seed files.');
        }
        $pdo->exec($schema);
        $pdo->exec($seed);
    }

    return $pdo;
}

function dt_setting_get(string $name, $default = null)
{
    $stmt = dt_db()->prepare('SELECT value FROM dt_settings WHERE key_name = :name');
    $stmt->execute([':name' => $name]);
    $value = $stmt->fetchColumn();
    if ($value === false) {
        return $default;
    }
    return $value;
}

function dt_setting_set(string $name, string $value): void
{
    $stmt = dt_db()->prepare('INSERT INTO dt_settings (key_name, value) VALUES (:name, :value)
        ON CONFLICT(key_name) DO UPDATE SET value = excluded.value');
    $stmt->execute([':name' => $name, ':value' => $value]);
}

function dt_state_get(): array
{
    $stmt = dt_db()->query('SELECT * FROM dt_state WHERE id = 1');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: [];
}

function dt_state_update(array $fields): void
{
    if (!$fields) {
        return;
    }
    $columns = [];
    $params = [];
    foreach ($fields as $key => $value) {
        $columns[] = "$key = :$key";
        $params[":$key"] = $value;
    }
    $sql = 'UPDATE dt_state SET ' . implode(', ', $columns) . ' WHERE id = 1';
    dt_db()->prepare($sql)->execute($params);
}

function dt_now_utc(): string
{
    return gmdate('Y-m-d H:i:s');
}
