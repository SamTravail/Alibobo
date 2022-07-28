<br>
<h1 style="color: lightseagreen">Liste des Catégories & Articles</h1>
<br>

<?php

$requeteCategoriesNiveau1 = "
    SELECT *
    FROM categories
    WHERE  categories_id_categorie=0
    ORDER BY libelle
";

$connexionCategories = new Sql();

$resultatCaterogies = $connexionCategories->select($requeteCategoriesNiveau1);

$menuCategories = "<ul class='article'>";

for ($i = 0 ; $i < count($resultatCaterogies) ; $i++) {
    $menuCategories .= "<li>";
        $requeteCategoriesNiveau2 = "
            SELECT *
            FROM categories
            WHERE  categories_id_categorie != 0
            ORDER BY libelle";

        $connexionCategories = new Sql();

        $resultatCaterogies = $connexionCategories->select($requeteCategoriesNiveau2);

        $menuCategories = "<ul class='article'>";

        for ($i = 0 ; $i < count($resultatCaterogies) ; $i++) {
            $menuCategories .= "<li>";
            $menuCategories .= "<a href=\"index.php?page=articles&amp;id_categorie=" . $resultatCaterogies[$i]['id_categorie'] . "\">";
            $menuCategories .= $resultatCaterogies[$i]['libelle'];
            $menuCategories .= "</a>";
            $menuCategories .= "</li>";
        }

        $menuCategories .= "<ul>";


        echo $menuCategories;
}
    $menuCategories .= "<a href=\"index.php?page=articles&amp;id_categorie=" . $resultatCaterogies[$i]['id_categorie'] . "\">";
    $menuCategories .= $resultatCaterogies[$i]['libelle'];
    $menuCategories .= "</a>";
    $menuCategories .= "</li>";


$menuCategories .= "<ul>";


echo $menuCategories;

if (isset($_GET['id_categorie'])) {
    $id_categorie = $_GET['id_categorie'];

    $requeteArticlesParCategorie = "
        SELECT *
        FROM articles
        WHERE id_categorie = $id_categorie
        ORDER BY designation
    ";

$connexionArticles = new Sql();
$resultatArticles = $connexionArticles->select($requeteArticlesParCategorie);

$articles = "<ul>";

    for ($i = 0 ; $i < count($resultatArticles) ; $i++) {
        $articles .= "<li>";
        $articles .= "<a href=\"index.php?page=articleDetail&amp;id_article=" . $resultatArticles[$i]['id_article'] . "\">";
        $articles .= $resultatArticles[$i]['designation'];
        $articles .= "</li>";
    }
    $articles .= "</ul>";
}
echo $articles;

