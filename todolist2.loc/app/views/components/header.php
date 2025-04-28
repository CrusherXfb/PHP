<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?? "TODOLIST" ?> </title>
    <base href="<?= PATH ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/main.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid container">
                    <a class="navbar-brand" href="">Планировщик задач</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a class="nav-link active" aria-current="page" href="tasks/index">Задачи</a>
                                <a class="nav-link" href="contacts">Контакты</a>
                                <a class="nav-link" href="tasks/create">Новая задача</a>
                            <?php endif; ?>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <li class="nav-item"><a class="nav-link" href="logout">Выйти</a></li>
                            <?php else: ?>
                                <li class="nav-item"><a class="nav-link" href="login">Войти</a></li>
                                <li class="nav-item"><a class="nav-link" href="register">Регистрация</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            </nav>
        </header>
        <?php getAlerts(); ?>