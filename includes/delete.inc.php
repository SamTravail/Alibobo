<?php
// Appel la fonction qui conecte à la BDD
require('functions/pdo.php');

// vérification de l'ID dans la BDD
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM formulaire WHERE id = $id";
   $query = $pdo->prepare($sql);
   $query ->bindValue(':id', $id, PDO::PARAM_INT);
   $query->execute();
   $beer = $query->fetch();
   

//  verification si l'id dans l'URL existe. s'il existe on fait une requete à la bdd delete
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // requete bdd
    $sql_supp = "DELETE  FROM formulaire WHERE id = :id";
    // on prepare une requête à l'exécution et retourne un objet
    $query = $pdo->prepare($sql_supp);
    //  on associe une valeur à un paramètre
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    // exécution de la requete
    $query->execute();
    // une fois la requete executé on retourne sur une autre page
    header('Location: editPost.php');
    }
   }
 else {
    // si erreur on arrete le code ab=vec message d'erreur
    //die('404');
   die("requete impossible. il y a une erreur");
}

 ?>