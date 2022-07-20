<!-- formulaire avec un choix options deroulant -->

<form action="" method="post" novalidate>
        <label for="title">Titre</label>
        <input type="text" name="title" required id="title" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } ?>">
        <span class="error"><?php if(!empty($errors['title'])) { echo $errors['title']; } ?></span>

        <label for="content">Contenu</label>
        <textarea name="content" id="content" cols="30" rows="10"><?php if(!empty($_POST['content'])) { echo $_POST['content']; } ?></textarea>
        <span class="error"><?php if(!empty($errors['content'])) { echo $errors['content']; } ?></span>

        <label for="author">Auteur</label>
        <input type="author" name="author" required id="author" value="<?php if(!empty($_POST['author'])) { echo $_POST['author']; } ?>">
        <span class="error"><?php if(!empty($errors['author'])) { echo $errors['author']; } ?></span>

        <!-- <label for="status">Status</label>
        <input type="status" name="status" required id="status" value="<?php if(!empty($_POST['status'])) { echo $_POST['status']; } ?>">
        <span class="error"><?php if(!empty($errors['status'])) { echo $errors['status']; } ?></span> -->
        <?php
    // pour offrir deux option à status création d'un tableau avec les 2 choix
            $status = array(
                'draft' => 'brouillon',
                'publish' => 'Publié'
            );

            ?>
            <select name="status">
                <option value="">---------------------</option>
                <!-- faire une fonction  -->
                <?php foreach ($status as $key => $value) {
                    $selected = '';
                    if(!empty($_POST['status'])) {
                        if($_POST['status'] == $key) {
                            $selected = ' selected="selected"';
                        }
                    }
                    ?>
                    <option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $value; ?></option>
                <?php } ?>


                <!-- formulaire simple -->

                
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

    <!-- ajouter un commentaire + formulaire commentaire -->
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
<!-- on edit par exemple l'utilisateur pour poouvoir proceder à la modification -->

<!-- Ajouter un commentaire création d'un formulaire html commentaire -->
    <h2>Ajouter un commentaire</h2>
    <form action="" method="post" class="wrap2">
        <label for="author">Auteur </label>
        <input type="text" name="author" value="<?=$article['author']?>">
        <span class="error"><?php if(!empty($errors['author'])) { echo $errors['author']; } ?></span>

        <label for="content">Commentaire </label>
        <textarea name="content"id="content2" cols="30" rows="10"><?=$article['content']; ?></textarea>
        <span class="error"><?php if(!empty($errors['content'])) { echo $errors['content']; } ?></span>

        <input type="submit" name="submitted" value="Ajouter">
    </form>
<!-- S'il n'y a pas d'absence de commentaire alors -->
    <?php if(!empty($comments)) { ?>
        <h2>Les commentaire</h2>
        <?php foreach ($comments as $comment) { ?>
            <div class="comment">
                <p>Auteur : <?= $comment['author']; ?></p>
                <p><?= $comment['content']; ?></p>
                <hr>
            </div>
        <?php } ?>
    <?php } ?>
</div>
