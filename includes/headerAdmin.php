<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alibobo - Administration</title>
    <link href="./assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <?php
        if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
            echo "<p>Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "</p>";
        }
        ?>
        <nav>
            <ul>
                <li><a href="index.php?page=accueil">Accueil</a></li>
            </ul>
        </nav>
    </header>