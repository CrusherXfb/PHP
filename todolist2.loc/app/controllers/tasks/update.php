<?php
//редактирование задачи
global $db;

require_once CLASSES . "/Validator.php";
require_once CORE . '/hashtag_helpers.php';

$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
    $task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->findOrAbort();

    //получение хэштегов для задачи для загрузки в форму
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

    $sql = "SELECT file_ FROM tasks WHERE id = :id AND user_id = :user_id";
    $currentTask = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->find();
    $file_path = $currentTask['file_'];

    if (isset($_FILES['file_']) && $_FILES['file_']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = STORAGE . '/uploads/';
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = $_FILES['file_']['name'];
        $file_tmp = $_FILES['file_']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $unique_file_name = uniqid() . '_' . $file_name;
        $upload_path = $upload_dir . $unique_file_name;
        
        if (move_uploaded_file($file_tmp, $upload_path)) {
            if (!empty($file_path) && file_exists(ROOT . '/' . $file_path)) {
                unlink(ROOT . '/' . $file_path);
            }
            $file_path = 'storage/uploads/' . $unique_file_name;
        } else {
            $_SESSION['error'] = "Ошибка при загрузке файла";
            redirect("tasks/update?id={$id}");
            return;
        }
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

        redirect("../tasks?id={$id}");
    } catch (Exception $e) {
        $_SESSION['error'] = "Ошибка при обновлении задачи: " . $e->getMessage();
        redirect("tasks/update?id={$id}");
    }
}