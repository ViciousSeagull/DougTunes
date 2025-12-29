CREATE TABLE IF NOT EXISTS dt_settings (
    key_name TEXT PRIMARY KEY,
    value TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS dt_state (
    id INTEGER PRIMARY KEY CHECK (id = 1),
    host_last_seen_utc TEXT,
    agent_last_seen_utc TEXT,
    requests_open INTEGER NOT NULL DEFAULT 1,
    requests_open_reason TEXT,
    commercials_enabled INTEGER NOT NULL DEFAULT 0,
    next_commercial_after INTEGER NOT NULL DEFAULT 0,
    songs_since_last_commercial INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS dt_queue (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    song_title TEXT NOT NULL,
    requested_by TEXT,
    votes INTEGER NOT NULL DEFAULT 0,
    created_utc TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS dt_library (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    song_title TEXT NOT NULL,
    artist TEXT,
    album TEXT
);
