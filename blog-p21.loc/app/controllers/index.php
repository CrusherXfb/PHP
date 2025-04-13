<?php

$title = "Blog";
$header = "Recent posts";

$sql = "SELECT * FROM posts ORDER BY post_id DESC";
$posts = $db->query($sql)->findAll();
//dd($posts);

require_once(VIEWS.'/index.tmpl.php');