<?php
global $db;

require_once CORE . '/classes/Validator.php';

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = h($_POST['current_password']) ?? '';
    $newPassword = h($_POST['new_password']) ?? '';
    $confirmPassword = h($_POST['confirm_password']) ?? '';
    
    $validator = new Validator();
    
    $rules = [
        'current_password' => ['required' => true],
        'new_password' => ['required' => true, 'min' => 6, 'no_spaces' => true],
        'confirm_password' => ['required' => true, 'match' => 'new_password']
    ];
    
    $validator->validate([
        'current_password' => $currentPassword,
        'new_password' => $newPassword,
        'confirm_password' => $confirmPassword
    ], $rules);
    
    $errors = $validator->getErrors();
    
    if (empty($errors)) {
        $user = $db->query("SELECT password FROM users WHERE id = :id", ['id' => $userId])->find();
        
        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $errors['current_password'] = ['Неверный текущий пароль'];
            $_SESSION['validation_errors'] = $errors;
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $db->query("UPDATE users SET password = :password WHERE id = :id", [
                'password' => $hashedPassword,
                'id' => $userId
            ]);
            
            $_SESSION['success'] = 'Пароль успешно изменен';
            redirect('/profile/settings');
        }
    } else {
        $_SESSION['validation_errors'] = $errors;
    }
}

$validation_errors = $_SESSION['validation_errors'] ?? [];
unset($_SESSION['validation_errors']);

$title = 'Настройки профиля';

require_once VIEWS . '/profile/settings.tmpl.php';