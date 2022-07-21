<?php 
// importation des fonction et de la connection à la base de données
require('include/functions.php');
require('include/pdo.php');

$title = "list_user";
?>
<?php
// requete pour selectionner tous les éléments de la bdd et les ordonner par date de création
$select_users = "SELECT * FROM formulaire ORDER BY created_at DESC";
// prepare la requete à l'éxecution et repour un objet
$query = $pdo->prepare($select_users);
// execute la requete
$query->execute();
// retourne tous les éléments et les affiche
$users = $query->fetchAll();
?>
<!-- tableau affichant la réponse en html -->
<h1>Liste des users</h1>
<table>
   <thead>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>prenom</th>
        <th>email</th>
        <th></th>
        <th></th>
    </tr>
   </thead>
   <tbody>
    <!-- pour chaque reponse afficher les paramètres demandé ici id, nom, prenom ... -->
<?php foreach ($users as $user) { ?>
    <tr>
        <td><?=$user['id']?></td>
        <td><?=$user['nom']?></td>
        <td><?=$user['prenom']?></td>
        <td><?=$user['email']?></td>
        <td><a href="modif_user.php?id=<?=$user['id']?>">Editer</a></td>
        <td><a href="supp_user.php?id=<?=$user['id']?>">Supprimer</a></td>
    </tr>
<?php } ?>
   </tbody>
</table>