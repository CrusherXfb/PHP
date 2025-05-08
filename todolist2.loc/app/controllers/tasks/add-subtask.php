<?php
//добавление подзадачи
global $db;

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'] ?? 0;
    $subtask_title = trim($_POST['subtask_title'] ?? '');
    
    if (empty($subtask_title) || empty($task_id)) {
        $_SESSION['error'] = "Название подзадачи не может быть пустым";
        redirect("/tasks?id={$task_id}");
    }
    
    $task = $db->query("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id", 
        ['id' => $task_id, 'user_id' => $_SESSION['user_id']])->find();
    
    if (!$task) {
        $_SESSION['error'] = "Задача не найдена или у вас нет прав доступа";
        redirect('/tasks/index');
    }
    
    $db->query("INSERT INTO subtasks (task_id, title, completed) VALUES (:task_id, :title, 0)", 
        ['task_id' => $task_id, 'title' => $subtask_title]);
    
    $_SESSION['success'] = "Подзадача добавлена";
    redirect("/tasks?id={$task_id}");
}