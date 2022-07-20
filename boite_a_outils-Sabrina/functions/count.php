<?php

function countArticle()
{
    // on appelle la bdd
    global $pdo;
    // requete bdd
    $sql = "SELECT COUNT(id) FROM articles";
    // on prépare la requête
    $query = $pdo->prepare($sql);
     // exécution de la requete
    $query->execute();
    // On utilise fetchColumn car ca retourne une somme
    return $query->fetchColumn();
}