<?php
//отображение задач
global $db;

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) { 
    redirect('/login');
}

// Include helper functions
require_once CORE . '/hashtag_helpers.php';
require_once CORE . '/task_helpers.php';

// Получаем параметр фильтра из GET запроса 
$filter = isset($_GET['filter']) ? h($_GET['filter']) : 'all';

// Получаем параметр вида отображения из GET запроса 
$view = isset($_GET['view']) ? h($_GET['view']) : 'grid';

// Сохраняем параметр вида отображения в сессии
if (isset($_GET['view'])) {
    $_SESSION['preferred_view'] = h($_GET['view']);
} elseif (isset($_SESSION['preferred_view'])) {
    $view = $_SESSION['preferred_view'];
}

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$params = [$_SESSION['user_id']];

// Добавляем условие фильтрации в зависимости от выбранного фильтра
if ($filter === 'active') {
    $sql .= " AND (completed = 0 OR completed IS NULL)";
} elseif ($filter === 'completed') {
    $sql .= " AND completed = 1";
}

$tasks = $db->query($sql, $params)->findAll();

// Передаем текущий фильтр и вид отображения в представление
$currentFilter = $filter;
$currentView = $view;

require_once TASKS_VIEWS . '/index.tmpl.php';
