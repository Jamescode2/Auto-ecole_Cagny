<?php
$retour = '';
$erreur = false;
function secure_donnee($donnee){
    if(ctype_digit($donnee)){
        return intval($donnee);
    }else{
        return addslashes($donnee);
    }
}
if (!isset($_POST)) {
    $erreur = true;
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

$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';
try {
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}


if(isset($_POST['pseudo']) && $_POST['pseudo'] != ''){	
    $longueur_chaine = strlen($_POST['pseudo']);
    if($longueur_chaine < 8 || $longueur_chaine > 15){
        $erreur = true;
        $retour .= 'Le pseudo doit être composé de 8 caractères minimum et ne doit pas dépasser 15 caractères.<br>';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['pseudo'])){
        $erreur = true;
        $retour .= 'Le pseudo saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
    }
    if (!checkConsecutiveChars($_POST['pseudo'])) {
        $erreur = true;
        $retour .= 'Le pseudo contient des caractères consécutifs.<br>';
    }
    if (!checkAlternateChars($_POST['pseudo'])) {
        $erreur = true;
        $retour .= 'Le pseudo contient des caractères alternatifs.<br>';
    }
} else {
    $erreur = true;
    $retour .= "Veuillez renseigner le champ 'pseudo'.<br />";
}
if(isset($_POST['mdp']) && $_POST['mdp'] != ''){	
    $longueur_chaine = strlen($_POST['mdp']);
    if($longueur_chaine < 8 || $longueur_chaine > 20){
        $erreur = true;
        $retour .= 'Le mot de passe doit être composé de 8 caractères minimum et ne doit pas dépasser 20 caractères.<br>';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['mdp'])){
        $erreur = true;
        $retour .= 'Le mot de passe  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
    }
    if (!checkConsecutiveChars($_POST['mdp'])) {
        $erreur = true;
        $retour .= 'Le mot de passe contient des caractères consécutifs.<br>';
    }
    if (!checkAlternateChars($_POST['mdp'])) {
        $erreur = true;
        $retour .= 'Le mot de passe contient des caractères alternatifs.<br>';
    }
} else {
    $erreur = true;
    $retour .= "Veuillez renseigner le champ 'mdp'.<br />";
}
if(isset($_POST['mail']) && $_POST['mail'] != ''){	
    $longueur_chaine = strlen($_POST['mail']);
    if($longueur_chaine < 12 || $longueur_chaine > 25){
        $erreur = true;
        $retour .= 'Le mail doit être composé de 12 caractères minimum et ne doit pas dépasser 25 caractères.<br>';
    }
    $exp = "/[a-zA-Z0-9]+[@]/";
    if(!preg_match($exp, $_POST['mail'])){
        $erreur = true;
        $retour .= 'La mail  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre avec "@".<br>';
    }
    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $erreur = true;
        $retour .= 'La mail  saisie n\'est pas valide.<br>';
    }
} else {
    $erreur = true;
    $retour .= "Veuillez renseigner le champ 'mail'.<br />";
}
if(!$erreur){
    $pseudo = (secure_donnee(trim($_POST['pseudo'])));
    //mdp
	$mdp = htmlentities(secure_donnee(trim($_POST['mdp'])));
    // hash
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
	$mail = htmlentities(secure_donnee(trim($_POST['mail'])));
    $query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo = :pseudo' );
    $query->bindParam( ':pseudo', $pseudo );
    $query->execute();
    foreach ( $query->fetchAll( PDO::FETCH_ASSOC ) as $row ) {
        $retour .= 'La référence saisie est déjà utilisée !<br>';
        $erreur = true;
        break;
    }
    $query->closeCursor();

    if ( !$erreur ) {
        $sql = "INSERT INTO utilisateurs VALUES(NULL,:mail,:pseudo,:mdp)";
        $requete = $bdd->prepare( $sql );
        $requete->bindParam( ':mail',  $mail );
        $requete->bindParam( ':pseudo', $pseudo );
        $requete->bindParam( ':mdp', $hash );
        if ( $requete->execute() ) {
            $retour .= 'L\'utilisateur a été ajouté avec succès.<br>';
        } else {
            $retour .= 'Une erreur est apparue lors de l\'ajout de l\'utilisateur.<br>';
        }
        $requete->closeCursor();
    } 
}

if ( $retour != '' ) {
    session_start();
    $_SESSION['retour'] = $retour;
}
header("Location:../assets/pages/Livre_d'or.php");
?>