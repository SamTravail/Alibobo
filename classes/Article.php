<?php
class Article
{
    public function affichArticle(int $id): string
    {

        $sql_edit_article = "SELECT * FROM articles WHERE id_article = $id";

        $connexionArticle = new Sql();

        $resultatArticle = $connexionArticle->select($sql_edit_article);

        $articlePage = "<ul>";
        $articlePage .= "<li>";
        $articlePage .= "<p>Référence : </p>" . $resultatArticle[0]['reference'] . "<br>";
        $articlePage .= "<p>Désignation : </p>" . $resultatArticle[0]['designation'] . "<br>";
        $articlePage .= $resultatArticle[0]['designation'] . "<br>";
        $articlePage .= $resultatArticle[0]['description'] . "<br>";
        $articlePage .= $resultatArticle[0]['puht'] . "<br>";
        $articlePage .= $resultatArticle[0]['masse'] . "<br>";
        $articlePage .= $resultatArticle[0]['qtestock'] . "<br>";
        $articlePage .= $resultatArticle[0]['qtestocksecu'] . "<br>";
        $articlePage .= "</li>";
        $articlePage .= "<a href=\"index.php?page=articleModif&amp;id_article=" . $resultatArticle[0]['id_article'] . "\">";
        $articlePage .=' <input  type="submit" name="submitted" value="modifier">  ';
        $articlePage .= "</a>";
        $articlePage .= "</ul>";

        return $articlePage;
    }
    public function updateArticle(string $sql, bool $count = false): array|int
    {
        if (!$count)
        {
            $resultat = $this->connexion->query($sql)->fetchAll();
            return $resultat;
        }
        else {
            $nbrResultat = $this->connexion->query($sql)->fetchColumn();
            return $nbrResultat;
        }

    }
    public function deleteArticle(string $sql): bool
    {
        $resultatDelete = $this->connexion->prepare($sql)->execute();
        if ($resultatDelete->rowCount() > 0)
            return true;
        else
            return false;
    }

}