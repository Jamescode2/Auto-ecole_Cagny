<?php
session_start();
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

$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';

try {

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}

//test erreur
if (isset($_POST['createMessage']) && $_POST['createMessage'] != '') {
    $longueur_chaine = strlen($_POST['createMessage']);
    if($longueur_chaine <= 8 || $longueur_chaine > 256){
        $erreur = true;
        $retour .= "Le message doit comporter, entre 8 et 256 caractères.<br />";
    }
}else{
    $erreur = true;
    $retour .= "Veuillez renseigner le champ 'createMessage'.<br />";
}

if(!$erreur){
    $createMessage = htmlentities(secure_donnee($_POST['createMessage']));
    $requete = $bdd->prepare("INSERT INTO `message` VALUES(NULL,:pseudo,:msg,NOW())");
    $requete->bindParam( ':pseudo',  $_SESSION['loginPostForm']);
    $requete->bindParam( ':msg',  $createMessage);
    $requete->execute();
    $requete->closeCursor();
}

if ( $retour != '' ) {
    $_SESSION['retour'] = $retour;
}

header("Location:../assets/pages/Livre_d'or.php");
?>