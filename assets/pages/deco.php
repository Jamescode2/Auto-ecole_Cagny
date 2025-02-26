<?php 
//on démarre une session ou la récupére si elle est déjà démarré
session_start(); 

	
//fonction permettant de déconnecter l'utilisateur
function deconnect() {
	//on detruit la session donc toutes les données associées à cette session
	session_destroy();
	//on détruit la variable globale session 
	unset($_SESSION);
	//on redirige l'utilisateur vers le Livre_d'or 
	header("Location:Livre_d'or.php");
	//et on ajoute exit pour que le serveur ne continue pas à travailler pour rien après la redirection
	exit();
}

//et on appel la fonction deconnect qui va permettre de déconnecter l'utilisateur...
deconnect();

?>