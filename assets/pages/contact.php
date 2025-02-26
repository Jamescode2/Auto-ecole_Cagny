<?php
$succes = '';
$echec = [];
$erreur = false;
$name = $firstname = $email = $tel = $message = '';
$Objet = 'Formulaire de contact';
function secure_donnee($donnee){
    if(ctype_digit($donnee)){
        return intval($donnee);
    }else{
        return addslashes($donnee);
    }
}
function checkConsecutiveChars($string) {
    $lastChar = '';
    $consecutiveCount = 0;
    for($i = 0; $i < strlen($string); $i++) {
        if($string[$i] == $lastChar) {
            $consecutiveCount++;
            if($consecutiveCount >= 3) {
                echo "Erreur : la chaîne contient des caractères consécutifs.";
                return false;
            }
        } else {
            $consecutiveCount = 1;
            $lastChar = $string[$i];
        }
    }
    return true;
}
if ( !isset( $_POST ) ) {
    $erreur = true;
}

if ( isset( $_POST[ 'name' ] ) && $_POST[ 'name' ] != '' ) {
    $longueur_chaine = strlen($_POST['name']);
    if($longueur_chaine < 3 || $longueur_chaine > 12){
        $erreur = true;
        $echec['name'] = 'Le nom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['name'])){
        $erreur = true;
        $echec['name'] = 'Le nom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.';
    }
    if (!checkConsecutiveChars($_POST['name'])) {
        $erreur = true;
        $echec['name'] = 'Le nom contient des caractères consécutifs.';
    }
    $name = htmlentities(secure_donnee(trim($_POST[ 'name' ])));
} else {
    $erreur = true;
    $echec['name']= 'Vous n\'avez pas tapez votre nom !';
}

if ( isset( $_POST[ 'firstname' ] ) && $_POST[ 'firstname' ] != '' ) {
    $longueur_chaine = strlen($_POST['firstname']);
    if($longueur_chaine < 3 || $longueur_chaine > 12){
        $erreur = true;
        $echec['firstname']= 'Le prénom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['firstname'])){
        $erreur = true;
        $echec['firstname']= 'Le prénom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.';
    }
    if (!checkConsecutiveChars($_POST['firstname'])) {
        $erreur = true;
        $echec['Prénom'] = 'Le prénom contient des caractères consécutifs.';
    }
    $firstname = htmlentities(secure_donnee(trim($_POST[ 'firstname' ])));
} else {
    $erreur = true;
    $echec['firstname']= 'Vous n\'avez pas tapez votre prénom !';
}

if ( isset( $_POST[ 'email' ] ) && $_POST[ 'email' ] != '' ) {
    if (filter_var($_POST[ 'email' ], FILTER_VALIDATE_EMAIL)) {
        $longueur_chaine = strlen($_POST['email']);
        if($longueur_chaine < 12 || $longueur_chaine > 25){
            $erreur = true;
            $echec['email'] = 'Le mail doit être composé de 12 caractères minimum et ne doit pas dépasser 25 caractères.';
        }
        $exp = "/[a-zA-Z0-9-.]+[@]/";
        if(!preg_match($exp, $_POST['email'])){
            $erreur = true;
            $echec['email'] = 'Le mail  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre avec "@".';
        }
        if (!checkConsecutiveChars($_POST['email'])) {
            $erreur = true;
            $echec['email'] = 'Le mail contient des caractères consécutifs.';
        }
        $email = htmlentities(secure_donnee(trim($_POST[ 'email' ])));
        $headers = 'FROM: '.$email;
    } else {
        $erreur = true;
        $echec['email'] = 'Le mail saisie n\'est pas valide.';
    }
} else {
    $erreur = true;
    $echec['email'] = 'Vous n\'avez pas tapez votre mail !';
}

if ( isset( $_POST[ 'tel' ] ) && $_POST[ 'tel' ] != '' ) {
    $longueur_chaine = strlen($_POST['tel']);
    if($longueur_chaine != 10){
        $erreur = true;
        $echec['tel'] = 'Le tel doit être composé de 10 caractères.';
    }
    $exp = "/[0-9]/";
    if(!preg_match($exp, $_POST['tel'])){
        $erreur = true;
        $echec['tel'] = 'Le tel saisie n\'est pas valide : il doit être composé que de chiffres.';
    }
    if (!checkConsecutiveChars($_POST['tel'])) {
        $erreur = true;
        $echec['tel'] = 'Le tel contient des caractères consécutifs.';
    }
    $tel = 'Telephone : '.htmlentities(secure_donnee(trim($_POST[ 'tel' ])));
}

if ( isset( $_POST[ 'Objet' ] ) && $_POST[ 'Objet' ] != '' ) {
    $longueur_chaine = strlen($_POST['Objet']);
    if($longueur_chaine < 3 || $longueur_chaine > 12){
        $erreur = true;
        $echec['Objet']= 'L\'Objet doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['Objet'])){
        $erreur = true;
        $echec['Objet']= 'L\'Objet saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.';
    }
    if (!checkConsecutiveChars($_POST['Objet'])) {
        $erreur = true;
        $echec['Objet'] = 'L\'Objet contient des caractères consécutifs.';
    }
    $Objet = htmlentities(secure_donnee($_POST[ 'Objet' ]));
} else {
    $erreur = true;
    $echec['Objet']= 'Vous n\'avez pas tapez votre Objet !';
}

if ( isset( $_POST[ 'message' ] ) && $_POST[ 'message' ] != '' ) {
    $longueur_chaine = strlen($_POST['message']);
    if($longueur_chaine < 8 || $longueur_chaine > 256){
        $erreur = true;
        $echec['message'] = 'Le message doit être composé de 2 caractères minimum et ne doit pas dépasser 256 caractères.';
    }
    if (!checkConsecutiveChars($_POST['message'])) {
        $erreur = true;
        $echec['message'] = 'Le message contient des caractères consécutifs.';
    }
    $message = $name . ' ' . $firstname . ' ('.$tel.'), a fait le message suivant : ' .htmlentities(secure_donnee($_POST[ 'message' ]));
} else {
    $erreur = true;
    $echec['message']= 'Vous n\'avez pas tapez votre message !';
}

if ( !$erreur ) {
    mail( 'jamesgnagne3@gmail.com', $Objet, $message, $headers );
    $succes = 'Votre message a bien été envoyé. Merci de m\'avoir contacté :)';
    session_start();
    $_SESSION[ 'succes' ] = $succes;
}

if ( $echec != [] ) {
    session_start();
    $_SESSION[ 'echec' ] = $echec;
}
header( 'Location:Agence.php' );

?>