<?php

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) {
    redirect('login');
}

$title = "Создание новой задачи";

require_once VIEWS . '/tasks/create.tmpl.php';