<?php

global $db;

// Подключение функций для работы с хэштегами
require_once APP . '/helpers/hashtag_helpers.php';

$id = (int)($_GET['id'] ?? 0);

$sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
$task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->findOrAbort();

$title = $task['title'];
require VIEWS . "/tasks/show.tmpl.php";