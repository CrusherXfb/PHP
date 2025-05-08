  document.addEventListener('DOMContentLoaded', function() {
      // Обработка изменения статуса задачи
      document.querySelectorAll('.task-checkbox').forEach(checkbox => {
          checkbox.addEventListener('change', function() {
              const taskId = this.dataset.id;
              const completed = this.checked ? 1 : 0;
            
              // Отправляем запрос на изменение статуса задачи
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
                      // Обновляем html
                      const titleElement = this.nextElementSibling;
                      if (completed) {
                          titleElement.classList.add('text-decoration-line-through');
                      } else {
                          titleElement.classList.remove('text-decoration-line-through');
                      }
                  } else {
                      // В случае ошибки
                      this.checked = !this.checked;
                      console.error('Error:', data.message);
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  // Возвращаем чекбокс в исходное состояние в случае ошибки
                  this.checked = !this.checked;
              });
          });
      });
  });