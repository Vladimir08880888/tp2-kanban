<?php
require_once __DIR__ . '/../controllers/TaskController.php';

$route = $_GET['route'] ?? 'list';

switch ($route) {
    case 'list':
    case '':
        listTasks();
        break;
    case 'add':
        addTask();
        break;
    case 'create':
        createTask();
        break;
    case 'edit':
        editTask();
        break;
    case 'update':
        updateTask();
        break;
    case 'delete':
        deleteTask();
        break;
    case 'update-status':
        updateTaskStatus();
        break;
    default:
        header('Location: index.php?route=list');
        exit;
}
