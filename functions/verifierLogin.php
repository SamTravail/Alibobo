<?php

function verifierLogin($email, $motdepasse) {
    if ($pdo = pdo()) {
        $motdepasse= password_verify($motdepasse, PASSWORD_DEFAULT);
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE email='$email' AND mdp='$motdepasse'";
        $reponse = $pdo->query($sql);
        $nbreLigne = $reponse->fetchColumn();
        if ($nbreLigne > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}