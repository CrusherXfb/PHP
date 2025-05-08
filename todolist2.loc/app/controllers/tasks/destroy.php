<?php
//удаление задачи
global $db;

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$data = $_POST;
$task_id = (int)$data['id'] ?? 0;

$sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
$post = $db->query($sql, ['id' => $task_id, 'user_id' => $_SESSION['user_id']])->find();

if ($db->rowCount()) {
    $resp['answer'] = $_SESSION['success'] = "Task deleted successfully";
} else {
    $resp['answer'] = $_SESSION['error'] = "Database error";
}

redirect("/tasks/index");
?>