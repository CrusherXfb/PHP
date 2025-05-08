<?php
//изменение статуса подзадачи
global $db;

require_once CORE . '/task_helpers.php';

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subtask_id = $_POST['subtask_id'] ?? 0;
    $completed = $_POST['completed'] ?? 0;
    
    //получаем подзадачу
    $sql = "SELECT s.*, t.id as task_id FROM subtasks s 
            JOIN tasks t ON s.task_id = t.id 
            WHERE s.id = :subtask_id AND t.user_id = :user_id";
    $subtask = $db->query($sql, [
        'subtask_id' => $subtask_id, 
        'user_id' => $_SESSION['user_id']
    ])->find();
    
    if (!$subtask) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Подзадача не найдена']);
        exit;
    }
    
    $db->query("UPDATE subtasks SET completed = :completed WHERE id = :id", 
        ['completed' => $completed, 'id' => $subtask_id]);
    
    $taskId = $subtask['task_id'];
    $allCompleted = areAllSubtasksCompleted($db, $taskId);
    
    if ($allCompleted) {
        $db->query("UPDATE tasks SET completed = 1 WHERE id = :id", ['id' => $taskId]);
    } else {
        $db->query("UPDATE tasks SET completed = 0 WHERE id = :id", ['id' => $taskId]);
    }
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'allCompleted' => $allCompleted
    ]);
    exit;
}