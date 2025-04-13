<?php
require_once(dirname(__DIR__) . '/config/config.php');

require_once(CORE . '/functions.php');

require_once(CLASSES . '/DB.php');
$db_config = require_once CONFIG . '/db.php';
$db = new DB($db_config);

require_once(CORE . '/router.php');














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


?>