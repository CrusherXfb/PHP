<?php
global $db;
require_once CLASSES.'/Paginator.php';


$title = "Blog";
$header = "Recent posts";


$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //запрос страницы
$per_page = 5;
$total = $db->query("SELECT count(*) FROM `posts`")->getColumn();
$pagination = new Paginator($page, $per_page, $total);




$start_elem = $pagination->getStartId();

$sql = "SELECT * 
        FROM posts 
        ORDER BY post_id 
        DESC 
        LIMIT $start_elem, $per_page";

$posts = $db->query($sql)->findAll();

require_once(POSTS_VIEWS . '/index.tmpl.php');










//dump($pagination);
// $per_page = 5; //элементов на странице
// $total = $db->query("SELECT count(*) FROM `posts`")->getColumn();
// $pages_count = ceil($total / $per_page); //всего страниц
// $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //запрос страницы

// if ($current_page < 1) {
//     $current_page = 1;
// } else if ($current_page > $pages_count) {
//     $current_page = $pages_count;
// }


// dump([
//     "total: $total",
//     "per page: $per_page",
//     "pages count: $pages_count",
//     "current page: $current_page",
//     "starting elem: $start_elem",
// ]);
//выборка
// dump (array_slice($data, $start_elem, $per_page));
// for ($i = 1; $i <= $pages_count; $i++) {
//     echo "<a href='?page={$i}'> {$i} </a>";
// }

