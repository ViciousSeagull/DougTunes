<?php

declare(strict_types=1);

function dt_get_header(string $name): ?string
{
    $normalized = strtoupper(str_replace('-', '_', $name));
    $serverKeys = [
        'HTTP_' . $normalized,
        'REDIRECT_HTTP_' . $normalized,
    ];

    foreach ($serverKeys as $key) {
        if (!empty($_SERVER[$key])) {
            return trim((string) $_SERVER[$key]);
        }
    }

    if (function_exists('getallheaders')) {
        $headers = getallheaders();
        foreach ($headers as $headerName => $value) {
            if (strcasecmp($headerName, $name) === 0) {
                return trim((string) $value);
            }
        }
    }

    return null;
}

function dt_require_admin(): void
{
    if (!empty($_SESSION['dt_is_admin'])) {
        return;
    }

    $key = $_GET['k'] ?? dt_get_header('X-DT-ADMIN-KEY');
    if ($key !== null && hash_equals(DT_ADMIN_KEY, (string) $key)) {
        $_SESSION['dt_is_admin'] = true;

        if (isset($_GET['k'])) {
            $url = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
            header('Location: ' . $url);
            exit;
        }
        return;
    }

    http_response_code(403);
    echo 'Admin access required.';
    exit;
}

function dt_require_key(string $expected): void
{
    $provided = dt_get_header('X-DT-KEY');
    if ($provided !== null && hash_equals($expected, $provided)) {
        return;
    }

    http_response_code(401);
    echo 'Unauthorized.';
    exit;
}
