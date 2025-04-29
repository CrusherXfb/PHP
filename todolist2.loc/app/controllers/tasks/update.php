<?php
global $db;

$id = (int) $_GET['id'] ?? 0;
$sql = "SELECT * FROM tasks WHERE id = ?";
$task = $db->query($sql, [$id])->findOrAbort();


// Обработка обновления задачи
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $priority = $_POST['priority'] ?? 'high';
    $due_date = $_POST['due_date'] ?? null;
    $hashtag = $_POST['hashtag'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // Обработка файла
    // if (isset($_FILES['file_']) && $_FILES['file_']['error'] === UPLOAD_ERR_OK) {
    //     // Обработка загрузки файла
    // }

    // Обновление задачи в базе данных
    $updateSql = "UPDATE tasks SET title = ?, description = ?, priority = ?, due_date = ?, hashtag = ?, comment = ? WHERE id = ?";


    if (
        $db->query($updateSql, [$title, $description, $priority, $due_date, $hashtag, $comment, $id])
    ) {
        $_SESSION['success'] = "Данные о задании обновлены";
    } else {
        $_SESSION['error'] = "Ошибка БД";
    }

    // Перенаправление после успешного обновления
    redirect("../tasks/index");
}

require VIEWS . '/tasks/update.tmpl.php';
?>