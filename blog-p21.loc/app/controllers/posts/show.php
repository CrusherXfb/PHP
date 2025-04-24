
<?php

global $db;

$id = (int)$_GET['id'] ?? 0;
// dump($id);
// dd([$_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']]);
$sql = "SELECT * FROM `posts` WHERE `post_id` = ?";
$post = $db->query($sql, [$id])->findOrAbort();

$title = "POST TITLE";
$header = $post['title'];
$rating = $post['rating'];

require_once POSTS_VIEWS.'/show.tmpl.php';