<?php
require_once __DIR__ . '/../models/todo_model.php';
require_once "../connexion.php";

// Ajouter une nouvelle tâche
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $title = $_POST['title'] ?? '';
    if (!empty($title)) {
        addTask($conn, $title);
        $message = "Tâche ajoutée avec succès !";
    }
    header("Location: ../views/todo.php?message=" . urlencode($message));
    exit();
}

// Mettre à jour l'état de la tâche (Done/Undo)
if (isset($_GET['action']) && $_GET['action'] == 'toggle') {
    $id = $_GET['id'];
    $is_done = $_GET['is_done'];
    updateTaskStatus($conn, $id, $is_done);
    $message = $is_done ? "Tâche marquée comme terminée." : "Annulation de l'état terminé.";
    header("Location: ../views/todo.php?message=" . urlencode($message));
    exit();
}

// Supprimer une tâche
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    deleteTask($conn, $id);
    $message = "Tâche supprimée avec succès.";
    header("Location: ../views/todo.php?message=" . urlencode($message));
    exit();
}
?>
