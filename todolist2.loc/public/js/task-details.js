document.addEventListener('DOMContentLoaded', function() {
    // Обработка чекбокса основной задачи
    document.querySelector('.task-checkbox').addEventListener('change', function() {
        const taskId = this.dataset.id;
        const completed = this.checked ? 1 : 0;
        
        fetch('tasks/toggle-task', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                task_id: taskId,
                completed: completed
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Обновление UI
                const titleElement = this.closest('.d-flex').querySelector('h3');
                if (completed) {
                    titleElement.classList.add('text-decoration-line-through');
                } else {
                    titleElement.classList.remove('text-decoration-line-through');
                }
            }
        });
    });
    
    // Функция для обновления прогресс-бара
    function updateProgressBar() {
        const subtasks = document.querySelectorAll('.subtask-checkbox');
        const completedSubtasks = document.querySelectorAll('.subtask-checkbox:checked');
        
        let progress = 0;
        if (subtasks.length > 0) {
            progress = Math.round((completedSubtasks.length / subtasks.length) * 100);
        }
        
        // Обновляем прогресс-бар
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = `${progress}%`;
            
            // Обновляем текст счетчика
            const countText = document.querySelector('.text-muted.mb-3');
            if (countText) {
                countText.textContent = `Выполнено: ${completedSubtasks.length}/${subtasks.length} подзадач`;
            }
        }
    }
    
    // Переключение статуса выполнения подзадачи
    document.querySelectorAll('.subtask-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const subtaskId = this.dataset.id;
            const completed = this.checked ? 1 : 0;
            
            fetch('tasks/toggle-subtask', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    subtask_id: subtaskId,
                    completed: completed
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Обновление UI
                    const textElement = this.nextElementSibling;
                    if (completed) {
                        textElement.classList.add('text-decoration-line-through');
                    } else {
                        textElement.classList.remove('text-decoration-line-through');
                    }
                    
                    // Обновляем прогресс-бар сразу после изменения статуса подзадачи
                    updateProgressBar();
                    
                    // Проверяем, все ли подзадачи выполнены
                    checkAllSubtasksCompleted();
                }
            });
        });
    });
    
    // Функция для проверки, все ли подзадачи выполнены
    function checkAllSubtasksCompleted() {
        const subtasks = document.querySelectorAll('.subtask-checkbox');
        const completedSubtasks = document.querySelectorAll('.subtask-checkbox:checked');
        
        if (subtasks.length > 0 && subtasks.length === completedSubtasks.length) {
            // Все подзадачи выполнены, отмечаем основную задачу как выполненную
            const taskCheckbox = document.querySelector('.task-checkbox');
            if (!taskCheckbox.checked) {
                taskCheckbox.checked = true;
                
                // Вызываем событие change для обновления на сервере
                const event = new Event('change');
                taskCheckbox.dispatchEvent(event);
            }
        }
    }
    
    // Удаление подзадачи
    document.querySelectorAll('.delete-subtask').forEach(button => {
        button.addEventListener('click', function() {
            
            const subtaskId = this.dataset.id;
            
            fetch('tasks/delete-subtask', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    subtask_id: subtaskId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Удаление из UI
                    this.closest('li').remove();
                    
                    // Обновляем прогресс-бар после удаления подзадачи
                    updateProgressBar();
                }
            });
        });
    });
    
    // Инициализация прогресс-бара при загрузке страницы
    updateProgressBar();
});
