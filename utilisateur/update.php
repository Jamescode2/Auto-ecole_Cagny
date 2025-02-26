<?php
session_start();
$retour = '';
$erreurnewPseudo = false;
$erreurnewMdp = false;
function isConnect() { 
	if (isset($_SESSION) && isset($_SESSION['loginPostForm']) && isset($_SESSION['passwordPostForm'])) {
		return true;
	}else {
		return false;
	}
}
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

function checkAlternateChars($string) {
    $lastChar = '';
    for($i = 0; $i < strlen($string); $i++) {
        if($i % 2 == 0) {
            if($string[$i] == $lastChar) {
                echo "Erreur : la chaîne contient des caractères alternatifs.";
                return false;
            }
            $lastChar = $string[$i];
        }
    }
    return true;
}
if (!isset($_POST)) {
    $erreurnewPseudo = true;
    $erreurnewMdp = true;
}
$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';
try {
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}

if (isConnect()) {
    if(isset($_POST['newPseudo']) && $_POST['newPseudo'] != ''){	
        $longueur_chaine = strlen($_POST['newPseudo']);
        if($longueur_chaine < 8 || $longueur_chaine > 15){
            $erreurnewPseudo = true;
            $retour .= 'Le newPseudo doit être composé de 8 caractères minimum et ne doit pas dépasser 15 caractères.<br>';
        }
        $exp = "/[a-zA-Z0-9]/";
        if(!preg_match($exp, $_POST['newPseudo'])){
            $erreurnewPseudo = true;
            $retour .= 'Le newPseudo saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        if (!checkConsecutiveChars($_POST['newPseudo'])) {
            $erreurnewPseudo = true;
            $retour .= 'Le newPseudo contient des caractères consécutifs.<br>';
        }
        if (!checkAlternateChars($_POST['newPseudo'])) {
            $erreurnewPseudo = true;
            $retour .= 'Le newPseudo contient des caractères alternatifs.<br>';
        }
    } else {
        $erreur = true;
        $retour .= "Veuillez renseigner le champ 'newPseudo'.<br />";
    }
    if(!$erreurnewPseudo && isset($_POST['newPseudo'])){
        $newPseudo = htmlspecialchars(secure_donnee(trim($_POST[ 'newPseudo' ])));
        $requete = $bdd->prepare( 'UPDATE utilisateurs SET pseudo = :newPseudo WHERE pseudo = :pseudo AND  mdp = :mdp' );
        $requete->bindParam( ':newPseudo', $newPseudo );
        $requete->bindParam( ':pseudo', $_SESSION['loginPostForm'] );
        $requete->bindParam( ':mdp', $_SESSION['passwordPostForm']);
        $requete->execute();
        $requete->closeCursor();
        $requete = $bdd->prepare( 'UPDATE message SET pseudo = :newPseudo WHERE pseudo = :pseudo' );
        $requete->bindParam( ':newPseudo', $newPseudo );
        $requete->bindParam( ':pseudo', $_SESSION['loginPostForm'] );
        $requete->execute();
        $requete->closeCursor();
        $_SESSION['loginPostForm'] = $newPseudo;
    }
}
if (isConnect()) {
    if(isset($_POST['newMdp']) && $_POST['newMdp'] != ''){	
        $longueur_chaine = strlen($_POST['newMdp']);
        if($longueur_chaine < 8 || $longueur_chaine > 20){
            $erreurnewMdp = true;
            $retour .= 'Le newMdp doit être composé de 8 caractères minimum et ne doit pas dépasser 20 caractères.<br>';
        }
        $exp = "/[a-zA-Z0-9]/";
        if(!preg_match($exp, $_POST['newMdp'])){
            $erreurnewMdp = true;
            $retour .= 'Le newMdp  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        if (!checkConsecutiveChars($_POST['newMdp'])) {
            $erreurnewMdp = true;
            $retour .= 'Le newMdp contient des caractères consécutifs.<br>';
        }
        if (!checkAlternateChars($_POST['newMdp'])) {
            $erreurnewMdp = true;
            $retour .= 'Le newMdp contient des caractères alternatifs.<br>';
        }
    } else {
        $erreur = true;
        $retour .= "Veuillez renseigner le champ 'newMdp'.<br />";
    }
    if(!$erreurnewMdp && isset($_POST['newMdp'])){
        $newMdp = htmlspecialchars(secure_donnee(trim($_POST[ 'newMdp' ])));
        $hash = password_hash($newMdp, PASSWORD_DEFAULT);
        $requete = $bdd->prepare( 'UPDATE utilisateurs SET mdp = :newMdp WHERE pseudo = :pseudo AND mdp = :mdp' );
        $requete->bindParam( ':newMdp', $hash );
        $requete->bindParam( ':pseudo', $_SESSION['loginPostForm'] );
        $requete->bindParam( ':mdp', $_SESSION['passwordPostForm']);
        $requete->execute();
        $requete->closeCursor();
        $_SESSION['passwordPostForm'] = $hash;
    }
}
if ( $retour != '' ) {
    $_SESSION['retour'] = $retour;
}
header("Location:../assets/pages/Livre_d'or.php");
?>