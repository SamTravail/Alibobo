<?php 
// importer les fonctions et le lien avec la bdd
require('include/functions.php');
require('include/pdo.php');
$title = "User";
// Traitement PHP
// Formulaire est soumis ???
$success = false;
// création d'un tableau d'erreur
$errors = array();
// vérifier si il y a un post submit
if(!empty($_POST['submitted']))

 {
    // Faille XSS trim pour enlever les espaces et strip_tags pour enlever les balises pour éviter l'injection de code
    $nom = trim(strip_tags($_POST['nom']));
    $prenom = trim(strip_tags($_POST['prenom']));
    $email = trim(strip_tags($_POST['email']));
    // Validation
    $errors = validText($errors,$nom,'nom',2,100);
    $errors = validText($errors,$prenom,'prenom',2,100);
    $errors = validEmail($errors, $email, 'email');

    // validation de mail
    // vérification de l'existance d'un mail
    if(!empty($email)) {
        // if email is valid
        // vérification si l'adresse mail est valide. si pas valide envoyer des message d'erreur
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez renseigner un email valide';
        }
    } else {
        $errors['email'] = 'Veuillez renseigner un email';
    }
    // si il n'y a pas d'erreur
    if(count($errors) === 0) {
        // insertion en BDD si aucune error en envoyant à la dbb une requete
        $sql = "INSERT INTO formulaire( nom, prenom, email, created_at) VALUES ( :nom, :prenom, :email, NOW());";
        // INJECTION SQL
        // prépare une requête à l'exécution et retourne un objet
        $query = $pdo->prepare($sql);
        // associe une valeur à un parametre
        $query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        //  execute la requete
        $query->execute();
        // Retourne l'identifiant de la dernière ligne insérée ou la valeur d'une séquence
        $last_id = $pdo->lastInsertId();
        // nvoie sur une autre page une fois la requete exécutée
        header('Location:list_user.php?id=' . $last_id);}
        $success = true;
 }
        ?>
        <!-- insertion du header (option) -->
<?php include('include/header.php'); ?>
<!-- création d'un formulaire html -->
    <h1>Ajouter un user  &#128526;</h1>
    <form action="" method="post" novalidate>
        <label for="nom">Nom</label>
        <input type="text" name="nom" required id="nom" value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } ?>">
        <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" required id="prenom" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; } ?>">
        <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>

        <label for="email">E-mail</label>
        <input type="email" name="email" required id="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>">
        <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>

        <input type="submit" name="submitted" value="Ajouter moi &#128523;">
    </form> 