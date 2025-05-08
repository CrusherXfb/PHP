<?php require_once COMPONENTS . "/header.php"; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Мой профиль</h2>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <div class="avatar-placeholder bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; margin: 0 auto;">
                                    <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                                </div>
                                <h4><?= h($user['username']) ?></h4>
                            </div>
                            <div class="col-md-9">
                                <h5 class="border-bottom pb-2">Информация о пользователе</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Дата регистрации:</strong> <?= $formattedDate ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>ID пользователя:</strong> <?= $user['id'] ?></p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="profile/settings" class="btn btn-outline-primary">
                                        <i class="bi bi-gear"></i> Настройки профиля
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Статистика задач</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Задачи</h6>
                                        <div class="d-flex justify-content-between">
                                            <p>Всего задач:</p>
                                            <p><strong><?= $taskStats['total_tasks'] ?></strong></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Выполнено:</p>
                                            <p><strong><?= $taskStats['completed_tasks'] ?></strong></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Активных:</p>
                                            <p><strong><?= $taskStats['total_tasks'] - $taskStats['completed_tasks'] ?></strong></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" id="tasks-progress-bar" role="progressbar" style="width: <?= $completionRate ?>%;" 
                                                 aria-valuenow="<?= $completionRate ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?= $completionRate ?>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Подзадачи</h6>
                                        <div class="d-flex justify-content-between">
                                            <p>Всего подзадач:</p>
                                            <p><strong><?= $subtaskStats['total_subtasks'] ?></strong></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Выполнено:</p>
                                            <p><strong><?= $subtaskStats['completed_subtasks'] ?></strong></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Активных:</p>
                                            <p><strong><?= $subtaskStats['total_subtasks'] - $subtaskStats['completed_subtasks'] ?></strong></p>
                                        </div>
                                        <?php 
                                        $subtaskCompletionRate = 0;
                                        if ($subtaskStats['total_subtasks'] > 0) {
                                            $subtaskCompletionRate = round(($subtaskStats['completed_subtasks'] / $subtaskStats['total_subtasks']) * 100);
                                        }
                                        ?>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" id="subtasks-progress-bar" role="progressbar" style="width: <?= $subtaskCompletionRate ?>%;" 
                                                 aria-valuenow="<?= $subtaskCompletionRate ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?= $subtaskCompletionRate ?>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS . "/footer.php"; ?>