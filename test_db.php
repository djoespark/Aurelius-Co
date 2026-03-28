<?php
try {
    // On force le mot de passe vide ici (le dernier argument est "")
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=aurelius-patrimoine", "root", "");
    echo "SUCCÈS : Connexion réussie sans mot de passe !";
} catch (PDOException $e) {
    echo "ÉCHEC : " . $e->getMessage();
}