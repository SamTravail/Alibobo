<?php

// Affichage la liste des pour les utilisateurs connectés avec les droits admin

if (verifierAdmin()) {
    if ($pdo = pdo()) {
        $champ = $_GET['champ'] ?? "libelle";
        $orderby = $_GET['orderby'] ?? "asc";

        $requeteCategories = "SELECT * FROM categories ORDER BY $champ $orderby";

        $tableauCategories = "<table>";
        $tableauCategories .= "<thead>";
        $tableauCategories .= "<tr>";
        $tableauCategories .= "<th>";
        $tableauCategories .= genererUrl('Catégories', 'Libelle', $champ, $orderby);
        $tableauCategories .= "</th>";
        $tableauCategories .= "</tr>";
        $tableauCategories .= "</thead>";
        $tableauCategories .= "<tbody>";

        $resultatRequeteCategories = $pdo->query($requeteCategories)->fetchAll();

        foreach($resultatRequeteCategories as $row) {
            $tableauCategories .= "<tr>";
            $tableauCategories .= "<td>" . $row['libelle'] . "</td>";
 //           $tableauCategories .= "<td><a href=\"index.php?page=articleDetailAdmin&amp;articleId=" . $row['id_categorie'] . "\">" . $row['libelle'] . "</a></td>";
            $tableauCategories .= "<td>&Eacute;diter</td>";
            $tableauCategories .= "<td>Supprimer</td>";
            $tableauCategories .= "</tr>";
        }

        $tableauCategories .= "</tbody>";
        $tableauCategories .= "</table>";

        echo $tableauCategories;

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