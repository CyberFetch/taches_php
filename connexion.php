<?php
// Configuration de la base de données
$host = "localhost";
$db_name = "todolist";
$username = "root";
$password = "";

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
