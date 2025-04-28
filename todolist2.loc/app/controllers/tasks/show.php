
<?php

global $db;

$id = (int)$_GET['id'] ?? 0;
$sql = "SELECT * FROM tasks WHERE id = ?";
$task = $db->query($sql, [$id])->findOrAbort();

require VIEWS . '/tasks/show.tmpl.php';