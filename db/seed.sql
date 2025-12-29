INSERT INTO dt_state (id, host_last_seen_utc, agent_last_seen_utc, requests_open, requests_open_reason, commercials_enabled, next_commercial_after, songs_since_last_commercial)
VALUES (1, NULL, NULL, 1, NULL, 0, 0, 0);

INSERT INTO dt_settings (key_name, value) VALUES
    ('COMMERCIAL_FREQUENCY_SONGS', '0')
ON CONFLICT(key_name) DO NOTHING;
