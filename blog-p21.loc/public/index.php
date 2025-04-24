<?php
session_start();


require_once(dirname(__DIR__) . '/config/config.php');
require_once(CORE . '/functions.php');
require_once(CLASSES . '/DB.php');
require_once(CLASSES . '/Router.php');

$db_config = require_once CONFIG . '/db.php';
$db = DB::getInstance()->getConnection($db_config);

$router = new Router();
require_once (CONFIG .'/routes.php'); //теперь здесь будут маршруты в формате $router->маршрут
$router->match();










//$data = range(1, 212); //выборка элементов

//dump($data);

// $per_page = 10; //элементов на странице
// $total = count($data); //всего элементов

// $pages_count = ceil($total / $per_page); //всего страниц

// $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //запрос страницы



// if ($current_page < 1) {
//     $current_page = 1;
// } else if ($current_page > $pages_count) {
//     $current_page = $pages_count;
// }

// $start_elem = ($current_page - 1) * $per_page;


// dump([
//     "total: $total",
//     "per page: $per_page",
//     "pages count: $pages_count",
//     "current page: $current_page",
//     "starting elem: $start_elem",
// ]);

// //выборка
// dump (array_slice($data, $start_elem, $per_page));

// for ($i = 1; $i <= $pages_count; $i++) {
//     echo "<a href='?page={$i}'> {$i} </a>";
// }






// $sql = "INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES 
// ('POST 1','post-1','This is a wider card with supporting text below as a natural lead-in to additional content.','This is a wider card with supporting text below as a natural lead-in to additional content.'),
// ('POST 2','post-2','This is a wider card with supporting text below as a natural lead-in to additional content.','This is a wider card with supporting text below as a natural lead-in to additional content.'),
// ('POST 3','post-3','This is a wider card with supporting text below as a natural lead-in to additional content.','This is a wider card with supporting text below as a natural lead-in to additional content.')"
// ;
//$c = $db->conn;
// $result = $c->exec($sql);
// dump($c);
// dd($result);


//1. Подготовка запроса $stmt = $c->prepare($sql) -> PDOStatement obj
//2. Привязка параметров $stmt->bindValue(///)
//3. Выполнение запроса $stmt->execute()

// $sql = "INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES 
// (:postTitle,:postSlug,:postExcerpt,:postContent)";
//1
// $stmt = $c->prepare($sql);

//Вариант 1
//dump($stmt);
// $title = "Post 4";
// $slug = "post-4";
// $excerpt = "This is a wider card with supporting text below as a natural lead-in to additional content.";
// //2
// $stmt->bindValue(":postTitle", $title);
// $stmt->bindValue(":postSlug", $slug);
// $stmt->bindValue(":postExcerpt", $excerpt);
// $stmt->bindValue(":postContent", $excerpt);
// dump($stmt);

// //3
// $result = $stmt->execute();
// dump($result);


//Вариант 2 (через массив)
// $title = "Post 6";
// $slug = "post-6";
// $excerpt = "This is a wider card with supporting text below as a natural lead-in to additional content.";

// $result = $stmt->execute([
//     ":postTitle" => $title,
//     ":postSlug" => $slug,
//     ":postExcerpt" => $excerpt,
//     ":postContent" => $excerpt,
// ]);
// dump($result);

//Вариант 3 (привязка по позициям)

// $sql = "INSERT INTO `posts`(`title`, `slug`, `excerpt`, `content`) VALUES (?,?,?,?)";
// $stmt = $c->prepare($sql);

// $title = "Post 7";
// $slug = "post-7";
// $excerpt = "This is a wider card with supporting text below as a natural lead-in to additional content.";

// $result = $stmt->execute([
//     $title,
//     $slug,
//     $excerpt,
//     $excerpt,
// ]);
// dump($result);


