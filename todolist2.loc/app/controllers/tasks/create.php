<?php
//форма создания задачи

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}


require_once VIEWS . '/tasks/create.tmpl.php';