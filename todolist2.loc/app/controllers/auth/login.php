<?php

global $db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $db->query($sql, ['username' => $username]);
    $user = $db->find();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        redirect('/');
        exit();
    } else {
        $_SESSION['error'] = "Неверное имя пользователя или пароль";
        redirect("login");
        exit();
    }
} else {
    require_once VIEWS . '/auth/login.tmpl.php';
    die;
}
