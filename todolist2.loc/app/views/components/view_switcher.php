<div class="btn-group" role="group" aria-label="Вид отображения">
    <a href="<?= $baseUrl ?>?view=grid<?= isset($currentFilter) ? '&filter='.$currentFilter : '' ?><?= isset($query) ? '&query='.urlencode($query) : '' ?>" 
       class="btn btn-outline-secondary <?= (!isset($currentView) || $currentView === 'grid') ? 'active' : '' ?>">
        <i class="fas fa-th"></i> Плитки
    </a>
    <a href="<?= $baseUrl ?>?view=list<?= isset($currentFilter) ? '&filter='.$currentFilter : '' ?><?= isset($query) ? '&query='.urlencode($query) : '' ?>" 
       class="btn btn-outline-secondary <?= (isset($currentView) && $currentView === 'list') ? 'active' : '' ?>">
        <i class="fas fa-list"></i> Список
    </a>
</div>