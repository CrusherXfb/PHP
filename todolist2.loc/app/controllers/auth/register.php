<?php

global $db;

require_once CORE . '/classes/Validator.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { //если форма отправлена
    $username = h($_POST['username']);
    $password = h($_POST['password']);
    $confirm_password = h($_POST['confirm_password'] ?? '');
    $email = h($_POST['email']);

    $validator = new Validator();
    
    $rules = [
        'username' => ['required' => true, 'min' => 3, 'max' => 30, 'no_spaces' => true],
        'password' => ['required' => true, 'min' => 6, 'max' => 50],
        'confirm_password' => ['required' => true, 'match' => 'password', 'no_spaces' => true],
        'email' => ['required' => true, 'email' => true]
    ];
    
    $validator->validate([
        'username' => $username,
        'password' => $password,
        'confirm_password' => $confirm_password,
        'email' => $email
    ], $rules);
    
    if (!$validator->hasErrors()) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $db->query($sql, ['username' => $username, 'email' => $email]);
        
        if ($db->find()) { //если имя пользователя или email заняты
            $_SESSION['error'] = "Имя пользователя или электронная почта уже заняты";
            $_SESSION['old'] = [
                'username' => $username,
                'email' => $email
            ];
            redirect("/register");
            exit();
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $db->query($sql, [ //создание нового пользователя
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email
        ]);

        $_SESSION['success'] = "Регистрация успешна";
        redirect("login");
        exit();
    } else {
        $_SESSION['validation_errors'] = $validator->getErrors();
        $_SESSION['old'] = [
            'username' => $username,
            'email' => $email
        ];
        redirect("register");
        exit();
    }
} else {
    $validation_errors = $_SESSION['validation_errors'] ?? [];
    unset($_SESSION['validation_errors']);
    
    require_once VIEWS . '/auth/register.tmpl.php';
}