<?php ob_start(); ?>
<div class="kanban-board">
    <?php foreach ($columns as $statusKey => $column): ?>
        <div class="kanban-column" data-status="<?= $statusKey ?>">
            <div class="column-header <?= $column['class'] ?>">
                <h2>
                    <?php if ($statusKey === 'todo'): ?><i class="fas fa-list"></i>
                    <?php elseif ($statusKey === 'in_progress'): ?><i class="fas fa-spinner"></i>
                    <?php else: ?><i class="fas fa-check-circle"></i><?php endif; ?>
                    <?= $column['title'] ?>
                </h2>
                <span class="task-count"><?= count($column['tasks']) ?></span>
            </div>
            <div class="tasks-container" data-status="<?= $statusKey ?>">
                <?php if (empty($column['tasks'])): ?>
                    <div class="empty-column"><i class="fas fa-inbox"></i><p>Aucune tâche</p></div>
                <?php else: ?>
                    <?php foreach ($column['tasks'] as $task): ?>
                        <div class="task-card" draggable="true" data-task-id="<?= $task['id'] ?>" data-status="<?= $task['status'] ?>">
                            <div class="task-header">
                                <h3 class="task-title"><?= htmlspecialchars($task['title']) ?></h3>
                                <div class="task-actions">
                                    <a href="index.php?route=edit&id=<?= $task['id'] ?>" class="btn-icon" title="Modifier"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?route=delete&id=<?= $task['id'] ?>" class="btn-icon btn-delete" title="Supprimer" onclick="return confirm('Supprimer?')"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <?php if (!empty($task['description'])): ?>
                                <div class="task-description">
                                    <div class="markdown-content">
                                        <script>document.currentScript.parentElement.innerHTML = marked.parse(<?= json_encode($task['description']) ?>);</script>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="task-footer">
                                <span class="task-date"><i class="far fa-clock"></i> <?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>
