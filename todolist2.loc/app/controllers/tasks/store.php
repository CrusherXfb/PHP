<?php

global $db;
require_once(CLASSES . "/Validator.php");
require_once APP . '/helpers/hashtag_helpers.php';

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$priority = $_POST['priority'] ?? 'high';
$due_date = !empty($_POST['due_date']) ? date('Y-m-d H:i:s', strtotime($_POST['due_date'])) : null;
$hashtags = trim($_POST['hashtags'] ?? '');
$comment = trim($_POST['comment'] ?? '');

$data = [
    'title' => $title,
    'description' => $description,
    'priority' => $priority,
    'due_date' => $due_date,
    'hashtags' => $hashtags,
    'comment' => $comment
];

$rules = [
    'title' =>
        [
            'required',
            'min' => 3,
            'max' => 255,
        ],
    'priority' =>
        [
            'required',
            'in' => 'high,medium,low',
        ],
];

$validator = new Validator();
$validationResult = $validator->validate($data, $rules);

if ($validationResult->hasErrors()) {
    // Сохраняем данные формы в сессии для повторного заполнения формы
    $_SESSION['old'] = $_POST;
    $_SESSION['validation_errors'] = $validationResult->getErrors();
    redirect("../tasks/create");
    return;
}

$file_path = null;

try {
    $sql = "INSERT INTO tasks (title, description, priority, due_date, comment, file_, user_id) 
            VALUES (:title, :description, :priority, :due_date, :comment, :file_, :user_id)";

    $params = [
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
        'due_date' => $due_date,
        'comment' => $comment,
        'file_' => $file_path,
        'user_id' => $_SESSION['user_id']
    ];

    $result = $db->query($sql, $params);

    if ($result) {
        // Получает ID последней вставленной строки
        $sql = "SELECT LAST_INSERT_ID() as id";
        $lastIdResult = $db->query($sql);
        $lastIdRow = $lastIdResult->find();
        $taskId = $lastIdRow['id'];

        // Обработка хэштегов
        if (!empty($hashtags)) {
            processHashtags($db, $taskId, $hashtags);
        }

        $_SESSION['success'] = "Задача успешно создана";
        redirect("../tasks?id={$taskId}");
    } else {
        throw new Exception("Failed to insert task");
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Ошибка при создании задачи: " . $e->getMessage();
    redirect("../tasks/create");
}
