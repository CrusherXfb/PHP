<?php
global $db;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'INCREASE') {
        $sql = "UPDATE posts SET rating = rating + 1 WHERE post_id = ?";
    } elseif ($action === 'DECREASE') {
        $sql = "UPDATE posts SET rating = rating - 1 WHERE post_id = ?";
    }

    $db->query($sql, [$postId])->findOrAbort();

    redirect("/posts?id=$postId");
}
?>
