
<?php



$id = (int)$_GET['id'] ?? 0;
$sql = "SELECT * FROM `posts` WHERE `post_id` = ?";
$post = $db->query($sql, [$id])->findOrAbort();

$title = "POST TITLE";
$header = $post['title'];

require_once VIEWS.'/post.tmpl.php';