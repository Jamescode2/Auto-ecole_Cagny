<?php
$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';
try {

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}
$sql = 'SELECT * FROM `message`';
$requete = $bdd->prepare($sql);
if($requete->execute()){
$all = $requete->fetchAll( PDO::FETCH_ASSOC );
echo json_encode( $all, JSON_PRETTY_PRINT );
}

?>