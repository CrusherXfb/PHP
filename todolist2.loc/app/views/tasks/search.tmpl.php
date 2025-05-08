<?php require_once(COMPONENTS . "/header.php");
require_once CORE . '/hashtag_helpers.php'; ?>
<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <?php if (isset($_SESSION['query']) && !empty($_SESSION['query'])): ?>
                        <h1>Результаты поиска по "<?= h($_SESSION['query']) ?>":</h1>
                    <?php endif; ?>

                    <div class="d-flex">
                        <!-- Переключатель вида отображения -->
                        <?php
                        $baseUrl = "tasks/search";
                        require(COMPONENTS . "/view_switcher.php");
                        ?>
                        <a href="tasks/index" class="btn btn-secondary ms-2">Назад к задачам</a>
                    </div>
                </div>



                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info">По вашему запросу ничего не найдено.</div>
                <?php else: ?>
                    <?php if (!isset($currentView) || $currentView === 'grid'): ?>
                        <!-- Отображение плитками -->
                        <div class="row">
                            <?php
                            foreach ($tasks as $task):
                                $showCheckbox = false; // Не показываем чекбоксы
                                $showProgress = false; // Не показываем прогресс-бар
                                require(COMPONENTS . "/task_card.php");
                            endforeach;
                            ?>
                        </div>
                    <?php else: ?>
                        <!-- Отображение списком -->
                        <div class="list-group">
                            <?php
                            foreach ($tasks as $task):
                                $showCheckbox = false; 
                                $showProgress = false; 
                                require(COMPONENTS . "/task_list_item.php");
                            endforeach;
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php require_once(COMPONENTS . "/footer.php"); ?>