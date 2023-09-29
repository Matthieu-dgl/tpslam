<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tp2auth', 'root', '');
    } catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>