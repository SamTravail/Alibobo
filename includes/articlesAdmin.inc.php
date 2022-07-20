<style>
    table {
        margin-left: auto;
        margin-right: auto;
        margin-top: 10px;
        padding-top: 5px;
    }
    tr {
        background-color: seagreen;
        border: solid 3px red;
        border-radius: 2%;
        text-align: center;
        padding-top: 5px;
        color: yellow;
        height: 4vh;
    }

    th {
        font-size: large;
        padding-top: 10px;
    }
    td {
        padding-top: 12px;
    }
</style>
<?php

// Affichage des articles pour les utilisateurs connectés avec les droits admin

if (verifierAdmin()) {
    if ($pdo = pdo()) {
        $champ = $_GET['champ'] ?? "designation";
        $orderby = $_GET['orderby'] ?? "asc";

        $requeteArticles = "SELECT * FROM articles ORDER BY $champ $orderby";

        $tableauResultats = "<table>";
        $tableauResultats .= "<thead>";
        $tableauResultats .= "<tr>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Catégories', 'categorie', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Référence";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Désignation', 'designation', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('PUHT', 'puht', $champ, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Taux de TVA";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Masse', 'masse', $champ, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Quantité en stock', 'qtestock', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Stock de sécurité', ' 	qtestockesecu ', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "</tr>";
        $tableauResultats .= "</thead>";
        $tableauResultats .= "<tbody>";

        $resultatRequeteArticles = $pdo->query($requeteArticles)->fetchAll();

        foreach($resultatRequeteArticles as $row) {
            $tableauResultats .= "<tr>";
            $tableauResultats .= "<td>" . $row['id_categorie'] . "</td>";
            $tableauResultats .= "<td>" . $row['reference'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=articleDetailAdmin&amp;articleId=" . $row['id_article'] . "\">" . $row['designation'] . "</a></td>";
            $tableauResultats .= "<td>" . $row['puht'] . "</td>";
            $tableauResultats .= "<td>" . $row['id_tva'] . "</td>";
            $tableauResultats .= "<td>" . $row['masse'] . "</td>";
            $tableauResultats .= "<td>" . $row['id_categorie'] . "</td>";
            $tableauResultats .= "<td>" . $row['qtestock'] . "</td>";
            $tableauResultats .= "<td>" . $row['qtestocksecu'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=articleDetailAdmin;articleId="  . "\">" . "Supprimer</a></td>";

            $tableauResultats .= "</tr>";

        }

        $tableauResultats .= "</tbody>";
        $tableauResultats .= "</table>";

        echo $tableauResultats;

    } else {
        echo "<p>Erreur PDO</p>";
    }
} else {
    $codeJs = "<p>Vous allez être redirigé dans 5 secondes.<br />Si la redirection n'est pas automatique, <a href=\"http://localhost:8080/DWWM-Vernon-2022-PHP-Alibobo/\">cliquez ici</a></p>";
    $codeJs .= "
    <script>
        setTimeout(function() {
            window.location.replace('http://localhost/alibobo/DWWM-Vernon-2022-PHP-Alibobo/index.php?page=accueil')
        }, 5000);
    </script>
    ";
    echo $codeJs;
}