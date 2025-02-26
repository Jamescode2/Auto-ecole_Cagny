<?php
session_start();
$retour = '';
$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';
function deconnect() {
	session_destroy();
	unset($_SESSION);
	header("Location:../assets/pages/Livre_d'or.php");
	exit();
}
try {

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}
$id='';
$requete = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo=:pseudo' );
$requete->bindParam( ':pseudo',$_SESSION['loginPostForm']);
$requete->execute();

while ($data = $requete->fetch())
{
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
{
    $retour .= 'Impossible de supprimer les données. Le nom de ce membre n\'est pas enregistré dans la base.<br>';
}
else
{
    $requete=$bdd->prepare('DELETE FROM utilisateurs WHERE id = :id') or die (print_r($bdd->errorInfo()));
    $requete->bindParam(':id',$id);
    $requete->execute();
    $requete->closeCursor();
    $ez=$bdd->prepare('DELETE FROM message WHERE pseudo=:pseudo') or die (print_r($bdd->errorInfo()));
    $ez->bindParam(':pseudo',$_SESSION['loginPostForm']);
    $ez->execute();
    $ez->closeCursor();
    $retour .= 'Les informations concernant le nouveau membre ont bien été supprimées de la base.<br>';
    deconnect();
}

if ( $retour != '' ) {
    $_SESSION['retour'] = $retour;
}
header("Location:../assets/pages/Livre_d'or.php");
?>