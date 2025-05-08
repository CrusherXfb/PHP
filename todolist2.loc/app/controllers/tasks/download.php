<?php
//скачивание файла
global $db;

$id = (int)($_GET['id'] ?? 0);

$sql = "SELECT file_ FROM tasks WHERE id = :id AND user_id = :user_id";
$task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->find();

if (!$task || empty($task['file_'])) {
    $_SESSION['error'] = "Файл не найден";
    redirect("../tasks?id={$id}");
    exit;
}

$file_path = ROOT . '/' . $task['file_'];

if (!file_exists($file_path)) {
    $_SESSION['error'] = "Файл не найден на сервере";
    redirect("../tasks?id={$id}");
    exit;
}

$file_name = basename($task['file_']);
$file_size = filesize($file_path);
$file_type = mime_content_type($file_path);

header('Content-Description: File Transfer'); 
header('Content-Type: ' . $file_type);
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . $file_size);
header('Pragma: public');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

// Устанавливает заголовки HTTP для правильной передачи файла:
// Content-Description - указывает, что передается файл
// Content-Type - устанавливает MIME-тип файла
// Content-Disposition: attachment - указывает браузеру, что файл нужно скачать, а не отобразить
// filename - задает имя файла при скачивании
// Content-Length - указывает размер файла
// Остальные заголовки управляют кешированием

ob_clean(); //очищает буфер вывода, чтобы избежать отправки лишних данных
flush(); //сбрасывает буфер вывода

readfile($file_path); //читает файл и отправляет его содержимое клиенту
exit;