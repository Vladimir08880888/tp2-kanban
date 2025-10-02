<?php
function getDatabase() {
    try {
        $db = new PDO('sqlite:' . __DIR__ . '/../database.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function getAllTasks() {
    $db = getDatabase();
    return $db->query('SELECT * FROM tasks ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
}

function getTaskById($id) {
    $db = getDatabase();
    $stmt = $db->prepare('SELECT * FROM tasks WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertTask($data) {
    $db = getDatabase();
    $stmt = $db->prepare('INSERT INTO tasks (title, description, status, created_at, updated_at) VALUES (:title, :description, :status, :created_at, :updated_at)');
    return $stmt->execute([
        'title' => $data['title'],
        'description' => $data['description'] ?? '',
        'status' => $data['status'] ?? 'todo',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
}

function updateTaskById($id, $data) {
    $db = getDatabase();
    $stmt = $db->prepare('UPDATE tasks SET title = :title, description = :description, status = :status, updated_at = :updated_at WHERE id = :id');
    return $stmt->execute([
        'id' => $id,
        'title' => $data['title'],
        'description' => $data['description'] ?? '',
        'status' => $data['status'] ?? 'todo',
        'updated_at' => date('Y-m-d H:i:s')
    ]);
}

function deleteTaskById($id) {
    $db = getDatabase();
    return $db->prepare('DELETE FROM tasks WHERE id = :id')->execute(['id' => $id]);
}

function updateTaskStatusById($id, $status) {
    $db = getDatabase();
    $stmt = $db->prepare('UPDATE tasks SET status = :status, updated_at = :updated_at WHERE id = :id');
    return $stmt->execute(['id' => $id, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
}
