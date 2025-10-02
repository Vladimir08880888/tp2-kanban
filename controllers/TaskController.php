<?php
require_once __DIR__ . '/../models/TaskModel.php';

function listTasks() {
    $allTasks = getAllTasks();
    $todoTasks = $inProgressTasks = $doneTasks = [];
    
    foreach ($allTasks as $task) {
        if ($task['status'] === 'todo') $todoTasks[] = $task;
        elseif ($task['status'] === 'in_progress') $inProgressTasks[] = $task;
        elseif ($task['status'] === 'done') $doneTasks[] = $task;
    }
    
    $columns = [
        'todo' => ['title' => 'À faire', 'tasks' => $todoTasks, 'class' => 'todo'],
        'in_progress' => ['title' => 'En cours', 'tasks' => $inProgressTasks, 'class' => 'in-progress'],
        'done' => ['title' => 'Terminé', 'tasks' => $doneTasks, 'class' => 'done']
    ];
    
    $pageTitle = 'Kanban Board';
    require __DIR__ . '/../views/tasks/list.php';
}

function addTask() {
    $pageTitle = 'Nouvelle tâche';
    require __DIR__ . '/../views/tasks/add.php';
}

function createTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        if (empty($_POST['title'])) $errors[] = 'Le titre est obligatoire';
        
        if (empty($errors)) {
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description'] ?? ''),
                'status' => $_POST['status'] ?? 'todo'
            ];
            if (insertTask($data)) {
                header('Location: index.php?route=list');
                exit;
            }
        }
        $pageTitle = 'Nouvelle tâche';
        require __DIR__ . '/../views/tasks/add.php';
    } else {
        header('Location: index.php?route=add');
        exit;
    }
}

function editTask() {
    $id = $_GET['id'] ?? null;
    if (!$id || !($task = getTaskById($id))) {
        header('Location: index.php?route=list');
        exit;
    }
    $pageTitle = 'Modifier la tâche';
    require __DIR__ . '/../views/tasks/edit.php';
}

function updateTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: index.php?route=list');
            exit;
        }
        $errors = [];
        if (empty($_POST['title'])) $errors[] = 'Le titre est obligatoire';
        
        if (empty($errors)) {
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description'] ?? ''),
                'status' => $_POST['status'] ?? 'todo'
            ];
            if (updateTaskById($id, $data)) {
                header('Location: index.php?route=list');
                exit;
            }
        }
        $task = getTaskById($id);
        $pageTitle = 'Modifier la tâche';
        require __DIR__ . '/../views/tasks/edit.php';
    } else {
        header('Location: index.php?route=list');
        exit;
    }
}

function deleteTask() {
    if ($id = $_GET['id'] ?? null) deleteTaskById($id);
    header('Location: index.php?route=list');
    exit;
}

function updateTaskStatus() {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['id'], $input['status'])) {
        http_response_code(400);
        exit(json_encode(['success' => false]));
    }
    if (!in_array($input['status'], ['todo', 'in_progress', 'done'])) {
        http_response_code(400);
        exit(json_encode(['success' => false]));
    }
    echo json_encode(['success' => updateTaskStatusById($input['id'], $input['status'])]);
    exit;
}
