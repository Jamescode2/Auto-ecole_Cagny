<?php
$erreur = false;
$nom = $prenom = $mail = $message = '';
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

if ( isset( $_POST[ 'nom' ] ) && $_POST[ 'nom' ] != '' ) {
    $longueur_chaine = strlen($_POST['nom']);
    if($longueur_chaine < 3 || $longueur_chaine > 12){
        $erreur = true;
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['nom'])){
        $erreur = true;
    }
    if (!checkConsecutiveChars($_POST['nom'])) {
        $erreur = true;
    }
    $nom = htmlentities(secure_donnee(trim($_POST[ 'nom' ])));
} else {
    $erreur = true;
}

if ( isset( $_POST[ 'prenom' ] ) && $_POST[ 'prenom' ] != '' ) {
    $longueur_chaine = strlen($_POST['prenom']);
    if($longueur_chaine < 3 || $longueur_chaine > 12){
        $erreur = true;
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['prenom'])){
        $erreur = true;
    }
    if (!checkConsecutiveChars($_POST['prenom'])) {
        $erreur = true;
    }
    $prenom = htmlentities(secure_donnee(trim($_POST[ 'prenom' ])));
} else {
    $erreur = true;
}

if ( isset( $_POST[ 'mail' ] ) && $_POST[ 'mail' ] != '' ) {
    if (filter_var($_POST[ 'mail' ], FILTER_VALIDATE_EMAIL)) {
        $longueur_chaine = strlen($_POST['mail']);
        if($longueur_chaine < 12 || $longueur_chaine > 25){
            $erreur = true;
        }
        $exp = "/[a-zA-Z0-9-.]+[@]/";
        if(!preg_match($exp, $_POST['mail'])){
            $erreur = true;
        }
        if (!checkConsecutiveChars($_POST['mail'])) {
            $erreur = true;
        }
        $mail = htmlentities(secure_donnee(trim($_POST[ 'mail' ])));
        $headers = 'FROM: '.$mail;
    } else {
        $erreur = true;
    }
} else {
    $erreur = true;
}


if (isset($_POST['DateReservation']) && isset($_POST['FinDateReservation'])) {
    $DateReservation = $_POST['DateReservation'];
    $FinDateReservation = $_POST['FinDateReservation'];
    $message = $nom . ' ' . $prenom . ', a fait une demande de réservation pour le : ' . $DateReservation.' au '.$FinDateReservation.', voici la motif de sa reservation : ';
} else {
  $erreur = true;
}

if ( isset( $_POST[ 'msg' ] ) && $_POST[ 'msg' ] != '' ) {
    $longueur_chaine = strlen($_POST['msg']);
    if($longueur_chaine < 8 || $longueur_chaine > 256){
        $erreur = true;
    }
    if (!checkConsecutiveChars($_POST['msg'])) {
        $erreur = true;
    }
    $msg = htmlentities(secure_donnee($_POST[ 'msg' ]));
    $message .= $msg;
} else {
    $erreur = true;
}

if ( !$erreur ) {
    mail( 'jamesgnagne3@gmail.com', 'Demande de reservation', $message, $headers );
}

header( 'Location:Agence.php' );

?>