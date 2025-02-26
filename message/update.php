<?php
session_start();
$retour = '';
$erreur = false;

function secure_donnee( $donnee ) {
    if ( ctype_digit( $donnee ) ) {
        return intval( $donnee );
    } else {
        return addslashes( $donnee );
    }
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

if ( !$erreur ) {
    if ( isset( $_POST[ 'modifMessage' ] ) && $_POST[ 'modifMessage' ] != '' ) {
        $longueur_chaine = strlen( $_POST[ 'modifMessage' ] );
        if ( $longueur_chaine <= 8 || $longueur_chaine > 256) {
            $erreur = true;
            $retour .= 'Le message doit comporter, entre 8 et 256 caractères.<br />';
        }
    } else {
        $erreur = true;
        $retour .= "Veuillez renseigner le champ 'modifMessage'.<br />";
    }
}

if ( !$erreur ) {
    $msg = htmlentities( secure_donnee( $_POST[ 'modifMessage' ] ) );
    $sql = 'UPDATE message SET msg = :msg WHERE pseudo = :pseudo AND id= :idMessage';
    $requete = $bdd->prepare( $sql );
    $requete->bindParam( ':msg',  $msg );
    $requete->bindParam( ':pseudo',  $_SESSION[ 'loginPostForm' ]);
    $requete->bindParam( ':idMessage',  $_POST[ 'idMessage' ]);
    if ( $requete->execute() ) {
        $retour .= 'Le message a été modifier avec succès.<br />';
    } else {
        $retour .= 'Une erreur est apparue lors de la modification du message.<br />';
    }
    $requete->closeCursor();
}

if ( $retour != '' ) {
    $_SESSION['retour'] = $retour;
}
header("Location:../assets/pages/Livre_d'or.php");
?>