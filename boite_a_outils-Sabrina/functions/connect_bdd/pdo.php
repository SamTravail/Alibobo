<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=vernon5', "root", "", array(
        // pour mettre tout le monde utf8
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        // recuperer sous forme de tableau ou onjet
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // cas d'erreur
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}