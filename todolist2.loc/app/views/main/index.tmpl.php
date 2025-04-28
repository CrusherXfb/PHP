<?php
//views/main/index.php

require COMPONENTS . '/header.php'; ?>

<main class="main py-3">
    <form action="auth" method="POST">
        <div class="jumbotron text-center">
            <h1 class="display-4">Добро пожаловать в Планировщик задач!</h1>
            <p class="lead">Это приложение поможет вам организовать ваши задачи и следить за их выполнением.</p>
            <hr class="my-4">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <p>Чтобы начать, пожалуйста, войдите или зарегистрируйтесь.</p>
                <a class="btn btn-primary btn-lg" href="login" role="button">Войти</a>
                <a class="btn btn-secondary btn-lg" href="register" role="button">Регистрация</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="container mt-5">
        <h2>Функции приложения:</h2>
        <ul>
            <li>Создание и управление задачами</li>
            <li>Установка сроков выполнения</li>
            <li>Отслеживание статуса задач</li>
        </ul>
    </div>
</main>


<?php require COMPONENTS . '/footer.php'; ?>