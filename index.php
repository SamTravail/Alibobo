<?php

session_start();

// Fonction permettant le chargement automatique des classes
spl_autoload_register(function ($className) {
    require_once './classes/' . $className . '.php';
});

require_once './functions/autoLoad.php';
autoLoad("*.php");

require __DIR__ . '/vendor/autoload.php';

// Définir le fuseau horaire dans lequel le serveur se trouve
date_default_timezone_set('Europe/Paris');

/* Utiliser include ou require
* include renvoie un avertissement simple en cas d'erreur
* require renvoie une erreur fatale et arrête l'exécution du script
*/

$utilisateur1 = new Utilisateur();
$utilisateur1->setNom("");
$utilisateur1->setPrenom("");
$utilisateur1->setEmail("");
$utilisateur1->insertion();

if (verifierAdmin()) 
    require_once './includes/headerAdmin.php';
else 
    require_once './includes/header.php';

require_once './includes/main.php';
require_once './includes/footer.php';
