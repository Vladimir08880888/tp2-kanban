<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Kanban Lite') ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1><i class="fas fa-columns"></i> Kanban Lite</h1>
            <nav>
                <a href="index.php?route=list" class="nav-link"><i class="fas fa-home"></i> Tableau</a>
                <a href="index.php?route=add" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle tâche</a>
            </nav>
        </div>
    </header>
    
    <main class="container">
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>
        <?= $content ?? '' ?>
    </main>
    
    <footer class="main-footer">
        <div class="container"><p>&copy; 2025 Kanban Lite - TP2</p></div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="js/drag-drop.js"></script>
</body>
</html>
