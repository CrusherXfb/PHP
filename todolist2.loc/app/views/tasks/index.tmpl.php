<?php require_once(COMPONENTS . "/header.php");
require_once CORE . '/hashtag_helpers.php'; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <!-- Подключаем боковую панель -->
            <?php require_once(COMPONENTS . "/sidebar.php"); ?>
            
            <div class="col-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Мои задачи</h1>
                    <a href="tasks/create" class="btn btn-primary">Создать задачу</a>
                </div>
                
                <!-- Фильтры и переключатель вида -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <?php 
                    $baseUrl = "tasks/index";
                    require(COMPONENTS . "/task_filters.php"); 
                    ?>
                    
                    <?php 
                    require(COMPONENTS . "/view_switcher.php"); 
                    ?>
                </div>
                
                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info">
                        <?php if (isset($currentFilter) && $currentFilter === 'active'): ?>
                            У вас нет активных задач.
                        <?php elseif (isset($currentFilter) && $currentFilter === 'completed'): ?>
                            У вас нет выполненных задач.
                        <?php else: ?>
                            У вас пока нет задач. Создайте новую задачу, чтобы начать.
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php if (!isset($currentView) || $currentView === 'grid'): ?>
                        <!-- Отображение плитками -->
                        <div class="row">
                            <?php 
                            foreach ($tasks as $task): 
                                $showCheckbox = true;
                                $showProgress = true;
                                require(COMPONENTS . "/task_card.php");
                            endforeach; 
                            ?>
                        </div>
                    <?php else: ?>
                        <!-- Отображение списком -->
                        <div class="list-group">
                            <?php 
                            foreach ($tasks as $task): 
                                $showCheckbox = true;
                                $showProgress = true;
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