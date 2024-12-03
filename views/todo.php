<?php
require_once dirname(__DIR__) . '/models/todo_model.php';
require_once dirname(__DIR__) . '/connexion.php';

$todos = getAllTasks($conn);

// Gestion des messages d'action
$message = '';
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn-done {
            width: 70px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-white bg-dark py-3">TodoList</h1>

        <!-- Afficher le message -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulaire pour ajouter une tâche -->
        <form action="../controllers/todo_controller.php" method="POST" class="d-flex mb-4">
            <input type="text" name="title" placeholder="Task Title" class="form-control me-2" required>
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        <!-- Liste des tâches -->
        <ul class="list-group">
    <?php foreach ($todos as $todo): ?>
        <li class="list-group-item task <?= $todo['is_done'] ? 'bg-success' : 'bg-warning' ?>">
            <span class="text-dark">
                <?= htmlspecialchars($todo['title']) ?>
            </span>

            <div>
                <!-- Bouton Done / Undo -->
                <a href="../controllers/todo_controller.php?action=toggle&id=<?= $todo['id'] ?>&is_done=<?= $todo['is_done'] ? 0 : 1 ?>"
                   class="btn btn-sm <?= $todo['is_done'] ? 'btn-warning' : 'btn-success' ?> btn-done">
                    <?= $todo['is_done'] ? 'Undo' : 'Done' ?>
                </a>

                <!-- Bouton Supprimer -->
                <a href="../controllers/todo_controller.php?action=delete&id=<?= $todo['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this task?')"
                   class="btn btn-sm btn-danger">X</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

