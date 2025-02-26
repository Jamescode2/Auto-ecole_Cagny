<?php
session_start();
$retour = '';
$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';

$loginAdmin = 'James';
$mdpAdmin = 'ezez';

try {
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}

$id = '';
$requete = $bdd->prepare( 'SELECT * FROM message WHERE pseudo=:pseudo AND id=:id' );
$requete->bindParam( ':pseudo', $_SESSION[ 'loginPostForm' ] );
$requete->bindParam( ':id', $_POST[ 'id' ] );
$requete->execute();

while ( $data = $requete->fetch() )
 {
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
 {
    if ( $_SESSION[ 'loginPostForm' ] == $loginAdmin && $_SESSION[ 'passwordPostForm' ] == $mdpAdmin ) {
        $admin = $bdd->prepare( 'DELETE FROM message WHERE id = :id' );
        $admin->bindParam( ':id', $_POST[ 'id' ] );
        $admin->execute();
        $admin->closeCursor();
    } else{
        $retour .= 'Impossible de supprimer les données. Le message de ce membre n\'est pas enregistré dans la base, ou le message n\'appartient pas au membre.<br>';
    }
} else {
    $requete=$bdd->prepare('DELETE FROM message WHERE id = :id') or die (print_r($bdd->errorInfo()));
    $requete->bindParam(':id',$id);
    $requete->execute();
    $retour .= 'Les informations concernant le message de ce membre ont bien été supprimées de la base.<br>';
    $requete->closeCursor();
}

if ( $retour != '' ) {
    $_SESSION['retour'] = $retour;
}

header("Location:../assets/pages/Livre_d'or.php");
?>