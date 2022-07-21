<?php

// Affichage des articles pour les utilisateurs connectés avec les droits admin

if (verifierAdmin()) {
    if ($pdo = pdo()) {
        $champ = $_GET['champ'] ?? "designation";
        $orderby = $_GET['orderby'] ?? "asc";

        $requeteArticles = "SELECT * FROM articles LEFT JOIN categories ON articles.id_categorie=categories.id_categorie LEFT JOIN tva ON articles.id_tva=tva.id_tva ORDER BY $champ $orderby";

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
        $tableauResultats .= genererUrl('Stock de sécurité', 'qtestocksecu ', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th colspan=\"2\">";
        $tableauResultats .= "Opérations";
        $tableauResultats .= "</th>";
        $tableauResultats .= "</tr>";
        $tableauResultats .= "</thead>";
        $tableauResultats .= "<tbody>";

        $resultatRequeteArticles = $pdo->query($requeteArticles)->fetchAll();

        foreach($resultatRequeteArticles as $row) {
            $tableauResultats .= "<tr>";
            $tableauResultats .= "<td>" . $row['libelle'] . "</td>";
            $tableauResultats .= "<td>" . $row['reference'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=articleDetailAdmin&amp;articleId=" . $row['id_article'] . "\">" . $row['designation'] . "</a></td>";
            $tableauResultats .= "<td class=\"alignRight\">" . $row['puht'] . "</td>";
            $tableauResultats .= "<td class=\"alignRight\">" . $row['indice'] . "</td>";
            $tableauResultats .= "<td class=\"alignRight\">" . $row['masse'] . "</td>";
            $tableauResultats .= "<td class=\"alignRight\">" . $row['qtestock'] . "</td>";
            $tableauResultats .= "<td class=\"alignRight\">" . $row['qtestocksecu'] . "</td>";
            $tableauResultats .= "<td>&Eacute;diter</td>";
            $tableauResultats .= "<td>Supprimer</td>";
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