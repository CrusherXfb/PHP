<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?? "TODOLIST" ?> </title>
    <base href="<?= PATH ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form class="d-flex mx-auto" role="search" action="tasks/search" method="GET">
                                <input class="form-control me-2" type="search" name="query" placeholder="Поиск задач"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Поиск</button>
                            </form>
                        <?php endif; ?>

                        <ul class="navbar-nav ms-auto">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle me-1"></i>
                                        <?= $_SESSION['username'] ?? 'Пользователь' ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="profile"><i class="bi bi-person me-2"></i>Мой
                                                профиль</a></li>
                                        <li><a class="dropdown-item" href="profile/settings"><i
                                                    class="bi bi-gear me-2"></i>Настройки</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="logout"><i
                                                    class="bi bi-box-arrow-right me-2"></i>Выйти</a></li>
                                    </ul>
                                </li>
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
        