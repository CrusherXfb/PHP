<?php

global $db;

function processHashtags($db, $taskId, $hashtagsString) {
    // Разделение полученной строки на отдельные хэштеги
    $hashtags = array_map('trim', explode(',', $hashtagsString));
    
    foreach ($hashtags as $hashtag) {
        //Пропускаем пустые
        if (empty($hashtag)) continue;
        //Удаляет # для сохранения в базу
        $hashtag = ltrim($hashtag, '#');
        //Проверяем на пустые вновь (после удаления #)
        if (empty($hashtag)) continue;
        
        // Проверяем, существует ли хэштэг в бд
        $sql = "SELECT id FROM hashtags WHERE name = :name";
        $result = $db->query($sql, ['name' => $hashtag]);
        $existingHashtag = $result ? $result->find() : null;
        if ($existingHashtag) {
            $hashtagId = $existingHashtag['id'];
        } else {
            // Если не существует, создаём новый
            $sql = "INSERT INTO hashtags (name) VALUES (:name)";
            $db->query($sql, ['name' => $hashtag]);
            
            // Получаем id добавленного хэштэга
            $sql = "SELECT LAST_INSERT_ID() as id";
            $lastIdResult = $db->query($sql);
            $lastIdRow = $lastIdResult->find();
            $hashtagId = $lastIdRow['id'];
        }
        
        // Проверка, есть ли уже у этой задачи этот хэштэг
        $sql = "SELECT 1 FROM task_hashtags WHERE task_id = :task_id AND hashtag_id = :hashtag_id";
        $result = $db->query($sql, [
            'task_id' => $taskId,
            'hashtag_id' => $hashtagId
        ]);
        $existingAssociation = $result ? $result->find() : null;
        
        if (!$existingAssociation) {
            // Создание связи между задачей и хэштэгом
            $sql = "INSERT INTO task_hashtags (task_id, hashtag_id) VALUES (:task_id, :hashtag_id)";
            $db->query($sql, [
                'task_id' => $taskId,
                'hashtag_id' => $hashtagId
            ]);
        }
    }
}


function getTaskHashtags($db, $taskId) {
    // Получает хэштеги задачи
    $sql = "SELECT h.id, h.name 
            FROM hashtags h
            JOIN task_hashtags th ON h.id = th.hashtag_id
            WHERE th.task_id = :task_id
            ORDER BY h.name";
    
    $result = $db->query($sql, ['task_id' => $taskId]);
    return $result ? $result->findAll() : [];
}

function listHashtags($hashtags) {
    // Выводит хэштеги в виде тегов (не работает :/)
    if (!empty($hashtags)) {
        echo '<div class="hashtags mb-3">';
        echo '<strong>Хэштеги:</strong>';
        foreach ($hashtags as $hashtag) {
            echo '<span class="badge bg-info text-dark me-1">#' . h($hashtag["name"]) . '</span>';
        }
        echo '</div>';
    }
}