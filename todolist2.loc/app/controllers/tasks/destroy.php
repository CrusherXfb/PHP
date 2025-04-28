<?php

global $db;



$data = file_get_contents('php://input');
$api_data = json_decode($data, true); //NULL | array
$data = $api_data ?? $_POST;
$task_id = (int)$data['id'] ?? 0;

$sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
$post = $db->query($sql, ['id' => $task_id, 'user_id' => $_SESSION['user_id']])->findOrAbort();

if ($db->rowCount()) {
    $resp['answer'] = $_SESSION['success'] = "Task deleted successfully";
} else {
    $resp['answer'] = $_SESSION['error'] = "Database error";
}

if ($api_data) {
    echo json_encode($resp);
    die;
}

redirect("tasks/index");
?>