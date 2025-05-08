<?php
//изменение статуса задачи
global $db;

require_once CORE . '/task_helpers.php';

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем тип запроса
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
    if (strpos($contentType, 'application/json') !== false) {
        // Получаем данные из JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        $task_id = $data['task_id'] ?? 0;
        $completed = $data['completed'] ?? 0;
    } else {
        // Получаем данные из формы
        $task_id = $_POST['task_id'] ?? 0;
        $completed = $_POST['completed'] ?? 0;
    }
    
    //получаем задачу
    $sql = "SELECT * FROM tasks WHERE id = :task_id AND user_id = :user_id";
    $task = $db->query($sql, [
        'task_id' => $task_id, 
        'user_id' => $_SESSION['user_id']
    ])->find();
    
    if (!$task) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Задача не найдена']);
        exit;
    }
    
    $db->query("UPDATE tasks SET completed = :completed WHERE id = :id", 
        ['completed' => $completed, 'id' => $task_id]);
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}