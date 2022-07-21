<?php
// chercher des liens dans le include
require('./include/pdo.php');
require('./include/functions.php');
include('./include/header.php'); 

?>
<?php
// vérifier que l'id existe s'il existe agir sur la bdd avec une requete select pour aller chercher l'info dans la bdd
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // requete bdd
    $sql_edit_user = "SELECT * FROM formulaire WHERE id = :id";
    // Prépare une requête à l'exécution et retourne un objet
    $query = $pdo->prepare($sql_edit_user);
    // associe une valeur à un paramètre
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    // executer le resultat de la requete
    $query->execute();
    // retourne 1 seul élément et l'affiche
    $user = $query->fetch();
debug($user);

// En cas d'erreur retourne un tableau
$errors = [];
if(!empty($_POST['submitted'])) {

    // Faille XSS enlève les espace avec trim et les balises avec strip_tags pour eviter l'injection de code
    $nom = trim(strip_tags($_POST['nom']));
    $prenom = trim(strip_tags($_POST['prenom']));
    $email = trim(strip_tags($_POST['email']));
    // Validation
    $errors = validText($errors,$nom,'nom',2,100);
    $errors = validText($errors,$prenom,'prenom',2,100);
    $errors = validEmail($errors, $email, 'email');

// Si pas d'erreur modification. un envoie la requete de modif a la bdd
    if(count($errors) === 0) {
        $requete_update = "UPDATE formulaire SET nom= :nom, prenom= :prenom, email = :email  WHERE id= :id";
        $query = $pdo->prepare($requete_update);
        $query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: user.php');
    }
}
?>
<!-- on edit par exemple l'utilisateur pour poouvoir proceder à la modification -->
<h1>Editer un utilisateur</h1>
    <form action="" method="post" novalidate>
        <label for="nom">
            <span>Nom :</span>
            <input type="text" name="nom" value="<?=$user['nom']?>">
            <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>

        </label>
        <label for="prenom">
            <span>Prenom :</span>
            <input type="text" name="prenom" value="<?=$user['prenom']?>">
            <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>
        </label>
        <label for="email">
            <span>Email :</span>
            <input type="text" name="email" value="<?=$user['email']?>">
            <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>
        </label>
        <input type="submit" name="submitted" value="Editer utilisateur">
    </form>
<?php } ?>