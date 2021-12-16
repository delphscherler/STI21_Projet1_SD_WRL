DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id          INTEGER PRIMARY KEY,
    username    TEXT    NOT NULL,
    password    TEXT    NOT NULL,
    validity    INTEGER DEFAULT 1,
    role        INTEGER,

    UNIQUE(username)
);

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
    id          INTEGER PRIMARY KEY,
    sender      INTEGER NOT NULL,
    receiver    INTEGER NOT NULL,
    subject     TEXT NOT NULL,
    date        TEXT NOT NULL,
    message     TEXT NOT NULL,

    FOREIGN KEY (sender)
        REFERENCES users (id)
            ON DELETE CASCADE
            ON UPDATE NO ACTION,
    FOREIGN KEY (receiver)
        REFERENCES users (id)
            ON DELETE CASCADE
            ON UPDATE NO ACTION
);