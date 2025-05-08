<?php
//удаление подзадачи
global $db;

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subtask_id = $_POST['subtask_id'] ?? 0;
    
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
    
    $db->query("DELETE FROM subtasks WHERE id = :id", ['id' => $subtask_id]);
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}