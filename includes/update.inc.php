<?php
// vérifier que l'id existe s'il existe agir sur la bdd avec une requete select pour aller chercher l'info dans la bdd
if(!empty($_GET['articleId']) && is_numeric($_GET['articleId'])) {
    $pdo=pdo();
    $id = $_GET['articleId'];
    // requete bdd
    $sql = "SELECT * FROM articles LEFT JOIN categories ON articles.id_categorie = categories.id_categorie  LEFT JOIN tva ON articles.id_tva = tva.id_tva WHERE id_article = $id";
    // Prépare une requête à l'exécution et retourne un objet
    $query = $pdo->query($sql)->fetch();

// En cas d'erreur retourne un tableau
    $errors = [];
    if(!empty($_POST['submitted'])) {

        // Faille XSS enlève les espace avec trim et les balises avec strip_tags pour eviter l'injection de code
        $categorie = trim(strip_tags($_POST['libelle']));
        $reference = trim(strip_tags($_POST['reference']));
        $designation = trim(strip_tags($_POST['designation']));
        $description = trim(strip_tags($_POST['description']));
        $puht = trim(strip_tags($_POST['puht']));
        $tva=trim(strip_tags($_POST['indice']));
        $qtestock = trim(strip_tags($_POST['qtestock']));
        $qtestocksecu = trim(strip_tags($_POST['qtestocksecu']));
        $masse = trim(strip_tags($_POST['masse']));
        // Validation

// Si pas d'erreur modification. un envoie la requete de modif a la bdd
        if(count($errors) === 0) {

            $requete_update ="  UPDATE `articles` SET `designation` = 'Lentille coraille', `description` = 'De magnifiques lentilles coraille !', `puht` = '742', `reference` = 'LENTILLECOf', `qtestock` = '921', `qtestocksecu` = '151', `masse` = '0.51', `id_categorie` = '41', `id_tva` = '41' WHERE `articles`.`id_article` =  $id";
            $query = $pdo->query($sql);
            $query->bindValue(':libelle',$categorie, PDO::PARAM_STR);
            $query->bindValue(':reference',$reference, PDO::PARAM_STR);
            $query->bindValue(':designation',$designation, PDO::PARAM_STR);
            $query->bindValue(':indice',$id, PDO::PARAM_INT);
            $query->bindValue(':description',$description, PDO::PARAM_STR);
            $query->bindValue(':puht',$puht, PDO::PARAM_STR);
            $query->bindValue(':qtestock',$qtestock , PDO::PARAM_STR);
            $query->bindValue(':qtestocksecu',$qtestocksecu , PDO::PARAM_STR);
            $query->bindValue(':masse',$masse, PDO::PARAM_INT);
            $query->execute();
            echo "<script>alert(`Article modifié`)</script>";
            echo "<script>window.location.replace('http://localhost/DWWM-Vernon-2022-PHP-Alibobo/index.php?page=articlesAdmin')</script>";
        }
    }var_dump($query);
    ?>
    <!-- on edit par exemple l'article pour poouvoir proceder à la modification -->
    <form action="index.php?page=update" method="post">
        <div>
            <label for="categorie">catégories:</label>
            <input type="text" id="categorie" name="categorie" value="<?= $query['libelle']?>"/>
        </div>
        <div>
            <label for="reference">réference :</label>
            <input type="text" id="reference" name="reference" value="<?= $query['reference']?>"/>
        </div>
        <div>
            <label for="designation">designation :</label>
            <input type="text" id="designation" name="designation" value="<?= $query['designation']?>"/>
        </div>
        <div>
            <label for="description">description :</label>
            <input type="text" id="description" name="description" value="<?= $query['description']?>"/>
        </div>
        <div>
            <label for="puht">puht :</label>
            <input type="text" id="puht" name="puht" value="<?= $query['puht']?>"/>
        </div>
        <div>
            <label for="tva">tva :</label>
            <input type="text" id="tva" name="tva" value="<?= $query['indice']?>"/>
        </div>
        <div>
            <label for="qtestock">qtestock :</label>
            <input type="text" id="qtestock" name="qtestock" value="<?= $query['qtestock']?>"/>
        </div>
        <div>
            <label for="qtestocksecu">qtestocksecu :</label>
            <input type="text" id="qtestocksecu" name="qtestocksecu" value="<?= $query['qtestocksecu']?>"/>
        </div>
        <div>
            <label for="masse">Masse</label>
            <input type="text" id="masse" name="masse" value="<?= $query['masse']?>" />
        </div>
        <div>
            <input type="submit" name="submitted" value="modifier">
            <input  type="submit" value="Supprimer" />
        </div>
        <input type="hidden" name="update" />

    </form>
<?php
}
