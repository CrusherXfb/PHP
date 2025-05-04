<?php

global $db;

if ($_SERVER["REQUEST_METHOD"] == "POST") { //если форма отправлена
    $username = h($_POST['username']);
    $password = h($_POST['password']);
    $email = h($_POST['email']);

    if (empty($username) || empty($password) || empty($email)) { //если поля пустые
        $_SESSION['error'] = "Все поля обязательны для заполнения";
        redirect("register");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $db->query($sql, ['username' => $username, 'email' => $email]);
    if ($db->find()) { //если имя пользователя или email заняты
        $_SESSION['error'] = "Имя пользователя или электронная почта уже заняты";
        redirect("register");
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
    require_once VIEWS . '/auth/register.tmpl.php';
}