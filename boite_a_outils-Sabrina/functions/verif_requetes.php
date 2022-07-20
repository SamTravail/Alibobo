<?php
// VERIFICATION DE REQUETE

// pour verifier si la requete est correcte et valider pour du text
function validText($er, $data, $key, $min, $max)
{
    if(!empty($data)) {
        if(mb_strlen($data) < $min) {
            $er[$key] = 'min '.$min.' caractères';
        } elseif(mb_strlen($data) >= $max) {
            $er[$key] = 'max '.$max.' caractères';
        }
    } else{
        $er[$key] = 'Veuillez renseigner ce champ';
    }
    return $er;
};
// pour verifier si la requete est correcte et valider pour des email
function validEmail($er, $data, $key)
{
    if(!empty($data)) {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
            $er[$key] = 'Veuillez renseigner un email valide';  
        }  
    } else{
        $er[$key] = 'Veuillez renseigner ce champ';
    }
    return $er;
}

// <!-- vérifier si le mail existe déjà -->
if(!empty($email)){
        
        $verif_email = $pdo->prepare("SELECT * FROM formulaire WHERE email=?");
        $verif_email->execute([$email]); 
        $user = $verif_email->fetch();
        if ($user) {
            $errors['email'] = 'cet email existe déjà';
        } 
        }   
?>



