<?php


global $db;

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$tasks = $db->query($sql, [$_SESSION['user_id']])->findAll();


require_once TASKS_VIEWS . '/index.tmpl.php';
