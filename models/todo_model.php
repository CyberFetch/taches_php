<?php

function getAllTasks($conn) {
    $query = "SELECT * FROM todo ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Assurez-vous que toutes les colonnes, y compris is_done, sont récupérées
}


function addTask($conn, $title) {
    $query = "INSERT INTO todo (title, is_done) VALUES (:title, 0)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $title);
    return $stmt->execute();
}

function updateTaskStatus($conn, $id, $is_done) {
    $query = "UPDATE todo SET is_done = :is_done WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':is_done', $is_done);
    return $stmt->execute();
}

function deleteTask($conn, $id) {
    $query = "DELETE FROM todo WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}
