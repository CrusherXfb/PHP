<?php

// Функция для получения количества подзадач
function getSubtaskCount($db, $taskId) {
    $sql = "SELECT COUNT(*) as count FROM subtasks WHERE task_id = :task_id";
    $result = $db->query($sql, ['task_id' => $taskId])->find();
    return $result ? $result['count'] : 0;
}

//Функция для получения количества выполненных подзадач
function getCompletedSubtaskCount($db, $taskId) {
    $sql = "SELECT COUNT(*) as count FROM subtasks WHERE task_id = :task_id AND completed = 1";
    $result = $db->query($sql, ['task_id' => $taskId])->find();
    return $result ? $result['count'] : 0;
}

//Функция для проверки все ли подзадачи выполнены
function areAllSubtasksCompleted($db, $taskId) {
    $total = getSubtaskCount($db, $taskId);
    $completed = getCompletedSubtaskCount($db, $taskId);
    
    return $total > 0 && $total === $completed;
}
