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
        $tableauResultats .= genererUrl('Désignation', 'designation', $champ, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "PUHT";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Taux de TVA";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Masse";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Quantité en stock";
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= "Stock de sécurité";
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
            window.location.replace('http://localhost:8080/DWWM-Vernon-2022-PHP-Alibobo/')
        }, 5000);
    </script>
    ";
    echo $codeJs;
}