<?php

global $db;

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) { 
    redirect('login');
}

$sql = "SELECT * FROM tasks WHERE user_id = ?"; //запрос всех задач пользователя
$tasks = $db->query($sql, [$_SESSION['user_id']])->findAll();


require_once TASKS_VIEWS . '/index.tmpl.php';
