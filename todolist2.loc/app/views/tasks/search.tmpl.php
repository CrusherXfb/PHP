<?php require_once(COMPONENTS . "/header.php");
require_once APP . '/helpers/hashtag_helpers.php'; ?>
<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Результаты поиска</h1>
                    <a href="tasks" class="btn btn-secondary">Назад к задачам</a>
                </div>

                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info">По вашему запросу ничего не найдено.</div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($tasks as $task): ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-truncate" style="max-width: 80%;"
                                            title="<?= h($task['title']) ?>">
                                            <?= h($task['title']) ?>
                                        </h5>
                                        <span
                                            class="badge <?= $task['priority'] === 'high' ? 'badge-danger' : ($task['priority'] === 'medium' ? 'badge-warning' : 'badge-success') ?>">
                                            <?= h(ucfirst($task['priority'])) ?>
                                        </span>
                                    </div>
                                    <div class="card-body py-2">
                                        <?php if (isset($task['due_date']) && !empty($task['due_date'])): ?>
                                            <p class="card-text mb-1 small">
                                                <i class="fas fa-calendar-alt"></i>
                                                <?= date('d.m.Y', strtotime($task['due_date'])) ?>
                                            </p>
                                        <?php endif; ?>

                                        <?php $hashtags = getTaskHashtags($db, $task['id']); ?>
                                        <?php if (!empty($hashtags)): ?>
                                            <div class="hashtags mt-2">
                                                <p>
                                                <div class="hashtags mb-3">
                                                    <strong>Хэштеги:</strong>
                                                    <?php foreach ($hashtags as $hashtag): ?>
                                                        <span class="badge bg-info text-dark me-1">#<?= h($hashtag["name"]) ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer bg-white border-top-0 pt-0">
                                        <div class="btn-group btn-group-sm w-100">
                                            <a href="tasks?id=<?= $task['id'] ?>" class="btn btn-outline-primary">Подробнее</a>
                                            <a href="tasks/update?id=<?= $task['id'] ?>"
                                                class="btn btn-outline-secondary">Изменить</a>
                                            <form action="tasks" method="POST" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                                <button type="submit" class="btn btn-outline-danger">Удалить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php require_once(COMPONENTS . "/footer.php"); ?>