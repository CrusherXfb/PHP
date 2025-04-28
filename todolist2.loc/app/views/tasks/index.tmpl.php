<?php require_once(COMPONENTS . "/header.php"); ?>


<main class="main py-3">
    <div class="container">
        <div class="row">
            <?php require_once COMPONENTS . "/sidebar.php"; ?>
            <div class="col">
                <h1>Список задач</h1>
                <ul class="list-group">
                    <?php foreach ($tasks as $task): ?>
                        <li class="list-group-item">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $task['title'] ?></h5>
                                    <p class="card-text"><?= $task['description'] ?></p>
                                    <!-- <p class="card-text"><small>Создано: <?= $task['created_at'] ?></small></p> -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge badge-primary mr-2"><?= $task['priority'] ?></span>
                                        <span class="badge badge-secondary ml-2"><?= $task['due_date'] ?></span>
                                    </div>
                                    <div class="btn-group mt-2">
                                        <a href="tasks?id=<?= $task['id'] ?>" class="btn btn-primary btn-sm">Подробнее</a>
                                        <form action="tasks" method="POST" style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>


<?php require_once(COMPONENTS . "/footer.php"); ?>