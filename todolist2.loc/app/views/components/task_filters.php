<div class="btn-group" role="group" aria-label="Фильтры задач">
    <a href="<?= $baseUrl ?>?filter=all<?= isset($currentView) ? '&view='.$currentView : '' ?>" 
       class="btn btn-outline-secondary <?= (!isset($currentFilter) || $currentFilter === 'all') ? 'active' : '' ?>">
        Все задачи
    </a>
    <a href="<?= $baseUrl ?>?filter=active<?= isset($currentView) ? '&view='.$currentView : '' ?>" 
       class="btn btn-outline-secondary <?= (isset($currentFilter) && $currentFilter === 'active') ? 'active' : '' ?>">
        Активные
    </a>
    <a href="<?= $baseUrl ?>?filter=completed<?= isset($currentView) ? '&view='.$currentView : '' ?>" 
       class="btn btn-outline-secondary <?= (isset($currentFilter) && $currentFilter === 'completed') ? 'active' : '' ?>">
        Выполненные
    </a>
</div>