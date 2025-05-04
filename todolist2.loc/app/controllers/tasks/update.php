<?php
global $db;

require_once APP . '/helpers/hashtag_helpers.php';
require_once CLASSES . "/Validator.php";

$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
    $task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->findOrAbort();

    $hashtags = getTaskHashtags($db, $id);
    $hashtags_string = implode(', ', array_map(function ($tag) {
        return $tag['name'];
    }, $hashtags));

    $title = "Редактирование задачи";
    require_once VIEWS . "/tasks/update.tmpl.php";
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
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
        'title' => ['required', 'min' => 3, 'max' => 255],
        'priority' => ['required', 'in' => 'high,medium,low']
    ];

    $validator = new Validator();
    $validationResult = $validator->validate($data, $rules);

    if ($validationResult->hasErrors()) {
        // Сохраняем данные формы и ошибки для отображения
        $_SESSION['old'] = $_POST;
        $_SESSION['validation_errors'] = $validationResult->getErrors();
        
        $task = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'due_date' => $due_date,
            'comment' => $comment
        ];
        
        // Передаем хэштеги для отображения
        $hashtags_string = $hashtags;
        
        $title = "Редактирование задачи";
        require_once VIEWS . "/tasks/update.tmpl.php";
        return;
    }

    $file_path = null;

    $sql = "SELECT file_ FROM tasks WHERE id = :id AND user_id = :user_id";
    $currentTask = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->find();

    if ($file_path === null && isset($currentTask['file_'])) {
        $file_path = $currentTask['file_'];
    }

    try {
        $sql = "UPDATE tasks SET 
                title = :title, 
                description = :description, 
                priority = :priority, 
                due_date = :due_date, 
                comment = :comment, 
                file_ = :file_,
                updated_at = :updated_at
                WHERE id = :id AND user_id = :user_id";

        $params = [
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'due_date' => $due_date,
            'comment' => $comment,
            'file_' => $file_path,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $id,
            'user_id' => $_SESSION['user_id']
        ];

        $result = $db->query($sql, $params);

        if ($result) {
            // Удаляем старые хэштеги
            $sql = "DELETE FROM task_hashtags WHERE task_id = :task_id";
            $db->query($sql, ['task_id' => $id]);

            // Добавляем новые хэштеги
            if (!empty($hashtags)) {
                processHashtags($db, $id, $hashtags);
            }

            $_SESSION['success'] = "Задача успешно обновлена";
        } else {
            throw new Exception("Failed to update task");
        }

        redirect("../tasks/index");
    } catch (Exception $e) {
        $_SESSION['error'] = "Ошибка при обновлении задачи: " . $e->getMessage();
        redirect("tasks/update?id={$id}");
    }
}