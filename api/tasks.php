<?php
// api/tasks.php
include '../config/database.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$pdo = getConnection();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single task by ID
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($task);
        } else {
            // Fetch all tasks
            $stmt = $pdo->query("SELECT * FROM tasks");
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tasks);
        }
        break;

    case 'POST':
        // Create a new task
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->execute([$data['title'], $data['description']]);
        echo json_encode(['message' => 'Task created successfully']);
        break;

    case 'PUT':
        // Update a task
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
            $stmt->execute([$data['title'], $data['description'], $data['status'], $_GET['id']]);
            echo json_encode(['message' => 'Task updated successfully']);
        }
        break;

    case 'DELETE':
        // Delete a task
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['message' => 'Task deleted successfully']);
        }
        break;

    default:
        echo json_encode(['message' => 'Method not allowed']);
}
