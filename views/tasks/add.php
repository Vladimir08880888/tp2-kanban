<?php ob_start(); ?>
<div class="form-container">
    <div class="form-header"><h2><i class="fas fa-plus-circle"></i> Créer une nouvelle tâche</h2></div>
    <form action="index.php?route=create" method="POST" class="task-form">
        <div class="form-group">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" id="title" name="title" required maxlength="255" placeholder="Titre de la tâche" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="description">Description (Markdown)</label>
            <textarea id="description" name="description" rows="10" placeholder="Décrivez votre tâche..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut <span class="required">*</span></label>
            <select id="status" name="status" required>
                <option value="todo" <?= (($_POST['status'] ?? 'todo') === 'todo') ? 'selected' : '' ?>>À faire</option>
                <option value="in_progress" <?= (($_POST['status'] ?? '') === 'in_progress') ? 'selected' : '' ?>>En cours</option>
                <option value="done" <?= (($_POST['status'] ?? '') === 'done') ? 'selected' : '' ?>>Terminé</option>
            </select>
        </div>
        <div class="form-actions">
            <a href="index.php?route=list" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer</button>
        </div>
    </form>
</div>
<script>new SimpleMDE({ element: document.getElementById("description"), spellChecker: false, status: false });</script>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>
