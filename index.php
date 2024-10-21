<?php
// index.php
echo json_encode([
    'message' => 'Welcome to the Task Manager API',
    'available_endpoints' => [
        'GET /api/tasks' => 'Fetch all tasks',
        'GET /api/tasks/{id}' => 'Fetch a specific task',
        'POST /api/tasks' => 'Create a new task',
        'PUT /api/tasks/{id}' => 'Update a task',
        'DELETE /api/tasks/{id}' => 'Delete a task',
    ]
]);
