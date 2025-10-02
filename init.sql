DROP TABLE IF EXISTS tasks;

CREATE TABLE tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    status TEXT NOT NULL DEFAULT 'todo',
    created_at TEXT NOT NULL,
    updated_at TEXT NOT NULL
);

INSERT INTO tasks (title, description, status, created_at, updated_at) VALUES
('Créer la base', '## Description\n\nBase SQLite créée.', 'done', datetime('now'), datetime('now')),
('Développer MVC', '## MVC\n\nArchitecture procédurale.', 'in_progress', datetime('now'), datetime('now')),
('SimpleMDE', '## Markdown\n\nÉditeur intégré.', 'todo', datetime('now'), datetime('now')),
('Drag & Drop', '## Bonus\n\nGlisser-déposer.', 'todo', datetime('now'), datetime('now')),
('Tests', '## Tests\n\nVérifier tout.', 'todo', datetime('now'), datetime('now'));
