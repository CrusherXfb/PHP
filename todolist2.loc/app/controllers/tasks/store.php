<?php

global $db;
require_once(CLASSES . "/Validator.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fillable = ['title', 'description', 'priority', 'due_date', 'hashtag', 'comment'];

    $data = loadPOSTData($fillable);

    $rules = [
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 50,
        ],
        'priority' => [
            'required' => true,
        ],
    ];


    $validator = new Validator();
    $validationResult = $validator->validate($data, $rules);
    $validationResult->hasErrors();

    if (empty($data['title'])) {
        $errors['title'] = "Task title is required";
    }
    if (empty($data['priority'])) {
        $errors['priority'] = "Task priority is required";
    }

    if (!$validationResult->hasErrors()) {
        
        $file_ = '';
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO tasks (title, description, priority, due_date, hashtag, comment, file_, user_id)
        VALUES (:title, :description, :priority, :due_date, :hashtag, :comment, :file_, :user_id)";
        if (
            $db->query($sql, [
                'title' => $data['title'],
                'description' => $data['description'],
                'priority' => $data['priority'],
                'due_date' => $data['due_date'],
                'hashtag' => $data['hashtag'],
                'comment' => $data['comment'],
                'file_' => $file_,
                'user_id' => $user_id,
            ])
        ) {
            $_SESSION['success'] = "Task created successfully";
        } else {
            $_SESSION['error'] = "Database error";
        }
    }

    // if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    //     $upload_dir = UPLOADS . '/';
    //     $file_path = $upload_dir . basename($_FILES['file']['name']);
    //     move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    // }
    redirect("../tasks/index");
    exit();
}



