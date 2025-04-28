<?php
//POSTS
 //все посты
// $router->get('posts', 'posts/show.php'); //отобразить пост
// $router->delete('posts', 'posts/destroy.php'); //удалить пост
// $router->put('posts/rating', 'posts/update-rating.php'); 

// карта маршрутов

//PAGES
$router->get('', 'main/main.php');
$router->get('contacts', 'contacts.php');

//auth
$router->get('login', 'auth/login.php'); // Форма входа
$router->post('login', 'auth/login.php'); // Обработка входа
$router->get('register', 'auth/register.php'); // Форма регистрации
$router->post('register', 'auth/register.php'); // Обработка регистрации
$router->get('logout', 'auth/logout.php'); // Выход

//tasks
$router->get('tasks/index', 'tasks/index.php'); // Все задачи
$router->get('tasks/create', 'tasks/create.php'); // Форма создания задачи
$router->post('tasks/create', 'tasks/store.php'); // Сохранение новой задачи
$router->get('tasks', 'tasks/show.php'); // Отображение задачи
$router->delete('tasks', 'tasks/destroy.php'); // Удаление задачи

