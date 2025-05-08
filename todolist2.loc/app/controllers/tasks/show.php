<?php
//отображение задачи
global $db;

// Подключение функций для работы с хэштегами и задачами
require_once CORE . '/hashtag_helpers.php';
require_once CORE . '/task_helpers.php';

$id = (int)($_GET['id'] ?? 0);

$sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
$task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->findOrAbort();

// Получение подзадач для текущей задачи
$sql = "SELECT * FROM subtasks WHERE task_id = :task_id ORDER BY id ASC";
$subtasks = $db->query($sql, ['task_id' => $id])->findAll();

$title = $task['title'];
require VIEWS . "/tasks/show.tmpl.php";