<?php
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
$router->get('tasks/update', 'tasks/update.php'); // Форма редактирования задачи
$router->post('tasks/update', 'tasks/update.php'); // Редактирование задачи
$router->get('tasks/search', 'tasks/search.php'); // Search tasks
$router->get('tasks/download', 'tasks/download.php'); // Download file
$router->post('tasks/toggle-task', 'tasks/toggle-task.php');

// Subtask 
$router->post('tasks/add-subtask', 'tasks/add-subtask.php');
$router->post('tasks/toggle-subtask', 'tasks/toggle-subtask.php');
$router->post('tasks/delete-subtask', 'tasks/delete-subtask.php');

$router->get('profile', 'profile/index.php'); 
$router->get('profile/settings', 'profile/settings.php'); 
$router->post('profile/settings', 'profile/settings.php'); 
