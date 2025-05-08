<?php
//сохранение задачи
global $db;
require_once(CLASSES . "/Validator.php");
require_once CORE . '/hashtag_helpers.php';

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

// Загрузка файла
if (isset($_FILES['file_']) && $_FILES['file_']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = STORAGE . '/uploads/';

    // Создаем директорию, если она не существует
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = $_FILES['file_']['name'];
    $file_tmp = $_FILES['file_']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Генерируем уникальное имя файла
    $unique_file_name = uniqid() . '_' . $file_name;
    $upload_path = $upload_dir . $unique_file_name;

    // Перемещаем загруженный файл в указанную директорию
    if (move_uploaded_file($file_tmp, $upload_path)) {
        $file_path = 'storage/uploads/' . $unique_file_name;
    } else {
        $_SESSION['error'] = "Ошибка при загрузке файла";
        redirect("../tasks/create");
        return;
    }
}

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
