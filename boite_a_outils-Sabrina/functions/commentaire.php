<?php
// appeller la bdd
global $pdo;
//    requête bdd
$sql = "SELECT * FROM comments WHERE id_article = :id";
// préparer la requête
$query = $pdo->prepare($sql);
//       // associe une valeur à un parametre
$query->bindValue(':id',$id,PDO::PARAM_INT);
// préparer à l'execution
$query->execute();
// recuperer tous les comentaires
$comments = $query->fetchAll();


// faire un tableau d'erreur
$errors = [];
if(!empty($_POST['submitted'])) {
    $author = trim(strip_tags($_POST['author']));
    $content = trim(strip_tags($_POST['content']));
    $errors = validText($errors,$content,'content',2,100);
    $errors = validText($errors, $author, 'author',2, 100);
    // Si pas d'erreur
    if(count($errors) == 0) {
        // inserer dans la bdd le commentaire 
        $sql = "INSERT INTO comments (id_article,content, author, created_at,modified_at,status)
            VALUES (:idarticle,:content,:author,NOW(),NOW(),'new')";
        $query = $pdo->prepare($sql);
              // associe une valeur à un parametre
        $query->bindValue(':author',$author,PDO::PARAM_STR);
        $query->bindValue(':content',$content,PDO::PARAM_STR);
        $query->bindValue(':idarticle',$id,PDO::PARAM_INT);
        $query->execute();
        // rediriger vers une page
        header('Location: single.php?id='.$id);
        // sinon tuer la requete
        die();
    }
}

?>
