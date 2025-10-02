# 📋 Kanban Lite – Clone de Trello

Application Kanban en PHP procédural, MVC, SQLite avec SimpleMDE et Drag & Drop.

## Installation

```bash
sqlite3 database.sqlite < init.sql
chmod 666 database.sqlite
cd public && php -S localhost:8000
```

Ouvrir: http://localhost:8000

## Structure MVC

- **Models**: TaskModel.php - Accès données SQLite
- **Views**: Templates PHP (list, add, edit)
- **Controllers**: TaskController.php - Logique métier
- **Router**: public/index.php - Routes GET

## Fonctionnalités

✅ CRUD complet  
✅ 3 colonnes Kanban (todo, in_progress, done)  
✅ SimpleMDE pour Markdown  
✅ Drag & Drop AJAX  
✅ Interface responsive

## Base de données

Table `tasks`: id, title, description, status, created_at, updated_at

Statuts: todo, in_progress, done
