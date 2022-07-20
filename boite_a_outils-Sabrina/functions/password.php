
<?php 
// HACHAGE MOT DE PASSE
// Création d'une clé de hachage pour un mot de passe
// Avertissement L'option Salt est obsolète. Il est préférable d'utiliser simplement le sel qui est généré par défaut. À partir de PHP 8.0.0, un sel explicitement fournit est ignoré.
/**
 * Nous voulons juste hacher notre mot de passe en utiliant l'algorithme par défaut.
 * Actuellement, il s'agit de BCRYPT, ce qui produira un résultat sous forme de chaîne de
 * caractères d'une longueur de 60 caractères.
 *
 * Gardez à l'esprit que DEFAULT peut changer dans le temps, aussi, vous devriez vous
 * y préparer en autorisant un stockage supérieur à 60 caractères (255 peut être un bon choix)
 */

echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);







// VERIFICATION QUE LE MOT DE PASSE CORRESPOND A UN HACHAGE

// Voir l'exemple fourni sur la page de la fonction password_hash()
// pour savoir d'où cela provient.
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Le mot de passe est valide !';
} else {
    echo 'Le mot de passe est invalide.';
}


 // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
 if(!empty($_REQUEST['password'])){
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($conn, $password);
 //requéte SQL + mot de passe crypté
   $query = "INSERT into `users` (username, email, password)
             VALUES ('$username', '$email', '".hash('sha256', $password)."')";
}


?>