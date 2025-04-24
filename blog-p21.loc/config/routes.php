<?php

// карта маршрутов

//POSTS
$router->get('', 'posts/index.php'); //все посты
$router->get('posts/create', 'posts/create.php'); //создать новый пост

$router->get('posts', 'posts/show.php'); //отобразить пост
$router->post('posts', 'posts/store.php');

$router->delete('posts', 'posts/destroy.php'); //удалить пост

$router->put('posts/rating', 'posts/update-rating.php'); 

//PAGES
$router->get('contacts', 'contacts.php');



