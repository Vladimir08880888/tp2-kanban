<?php ob_start(); ?>
<div class="form-container">
    <div class="form-header"><h2><i class="fas fa-edit"></i> Modifier la tâche</h2></div>
    <form action="index.php?route=update" method="POST" class="task-form">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <div class="form-group">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" id="title" name="title" required maxlength="255" value="<?= htmlspecialchars($task['title']) ?>">
        </div>
        <div class="form-group">
            <label for="description">Description (Markdown)</label>
            <textarea id="description" name="description" rows="10"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut <span class="required">*</span></label>
            <select id="status" name="status" required>
                <option value="todo" <?= ($task['status'] === 'todo') ? 'selected' : '' ?>>À faire</option>
                <option value="in_progress" <?= ($task['status'] === 'in_progress') ? 'selected' : '' ?>>En cours</option>
                <option value="done" <?= ($task['status'] === 'done') ? 'selected' : '' ?>>Terminé</option>
            </select>
        </div>
        <div class="form-info">
            <p><i class="far fa-clock"></i> <strong>Créée:</strong> <?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></p>
            <p><i class="fas fa-sync-alt"></i> <strong>Modifiée:</strong> <?= date('d/m/Y H:i', strtotime($task['updated_at'])) ?></p>
        </div>
        <div class="form-actions">
            <a href="index.php?route=list" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </div>
    </form>
</div>
<script>new SimpleMDE({ element: document.getElementById("description"), spellChecker: false, status: false });</script>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>
