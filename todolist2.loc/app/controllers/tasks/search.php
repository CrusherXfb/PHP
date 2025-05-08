<?php
//поиск задач
global $db;

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$title = "Поиск задач";
$query = trim($_GET['query'] ?? '');
$_SESSION['query'] = $query;
$tasks = [];


// Если в GET запросе есть параметр view, используем его и сохраняем в сессии
if (isset($_GET['view'])) {
    $currentView = $_GET['view'];
    $_SESSION['preferred_view'] = $currentView;
    // Иначе, если в сессии есть сохраненный выбор, используем его
} elseif (isset($_SESSION['preferred_view'])) {
    $currentView = $_SESSION['preferred_view'];
} else {
    $currentView = 'grid';
}

if (!empty($query)) {
    $userId = $_SESSION['user_id'];

    // Проверяем, начинается ли запрос с символа #
    if ($query[0] == '#') {
        // Удаляем символ # из запроса для поиска по хэштегам
        $hashtagName = substr($query, 1);

        // SQL запрос для поиска задач по хэштегу
        $sql = "SELECT DISTINCT t.* FROM tasks t
                JOIN task_hashtags th ON t.id = th.task_id
                JOIN hashtags h ON th.hashtag_id = h.id
                WHERE t.user_id = :user_id 
                AND h.name = :hashtag_name";

        $result = $db->query($sql, [
            'user_id' => $userId,
            'hashtag_name' => $hashtagName
        ]);
    } else {
        // Обычный поиск по всем полям задачи и по тегам
        $searchParam = "%{$query}%";

        // SQL запрос для поиска задач по всем полям
        $sql = "SELECT DISTINCT t.* FROM tasks t
                LEFT JOIN task_hashtags th ON t.id = th.task_id
                LEFT JOIN hashtags h ON th.hashtag_id = h.id
                WHERE t.user_id = :user_id 
                AND (
                    t.title LIKE :query 
                    OR t.description LIKE :query 
                    OR t.comment LIKE :query
                    OR h.name LIKE :query
                )";

        $result = $db->query($sql, [
            'user_id' => $userId,
            'query' => $searchParam
        ]);
    }

    if ($result) {
        $tasks = $result->findAll();
    }
}

require_once VIEWS . "/tasks/search.tmpl.php";