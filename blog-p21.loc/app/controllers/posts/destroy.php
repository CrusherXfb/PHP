<?php
global $db;


$data = file_get_contents('php://input');
$api_data = json_decode($data, true); //NULL | array
$data = $api_data ?? $_POST;
$id = (int)$data['id'] ?? 0;

$sql = "DELETE FROM `posts` WHERE `post_id` = ?";
$post = $db->query($sql, [$id])->findOrAbort();

if ($db->rowCount()) {
    $resp['answer'] = $_SESSION['success'] = "Post deleted successfully";
} else {
    $resp['answer'] = $_SESSION['error'] = "Database error";
}

if ($api_data) {
    echo json_encode($resp);
    die;
}

redirect('/');