<?php
//on démarre une session ou la récupére si elle est déjà démarré
session_start();
// On initialise une variable dans laquelle nous allons stocker des retours PHP
$retour = '';
// On initialise une variable booléenne qui nous permettra de savoir si une erreur a été rencontrée
$erreur = false;

// On initialise deux variable dans laquelle nous allons stocker le login et le mdp admin
$loginAdmin = 'James';
$mdpAdmin = 'ezez';

// Paramétres et connexion à la base de données
$dbhost = 'localhost';
$dbname = 'auto_ecole';
$dbuser = 'root';
$dbpass = '';

// CONNEXION A LA BASE MySQL //
	/* 
		La structure try ... catch permet de réaliser les actions suivantes :
		PHP essaie d'exécuter les instructions présentes à l'intérieur du bloc "try"
		En cas d'erreur, les instructions du bloc "catch" sont exécutées.
		Dans ce cas, un message d'erreur est affiché.
	*/
try {
    /* 
			PDO est une extension "orientée objet". Il faut donc vérifier que l'extension PDO est bien activée sur votre version de PHP (cf cours)
			On travaille en local : localhost
			La BDD s'appelle "exemple_diag_php_dbb"
			Le login par défaut est "root"
			Il n'y a pas de mot de passe
			On crée un objet $bdd
		*/
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
	// Mettez un nom de base erroné pour voir apparaétre le message d'erreur 

} catch( Exception $e ) {
	// On lance une fonction PHP qui permet de connaître l'erreur renvoyée lors de la connection à la base
    die( 'Erreur : ' . $e->getMessage() );
}

//fonction permettant de connecter l'utilisateur en passant par la session
function setConnected($loginPostForm, $passwordPostForm) {
	//si la variable  session existe et est non nul
	if (isset($_SESSION)) {
		//on stocke dans les variables de sessions login et mdp les valeurs des variables en paramètre login et mot de passe 
		//(qui seront celles renseignés par l'utilisateur dans le form envoyé avec la méthode POST d'où le nom des variables)
		$_SESSION['loginPostForm'] = $loginPostForm; 
		$_SESSION['passwordPostForm'] = $passwordPostForm;
	}
}

//fonction permettant de vérifier si un utilisateur a une session active, s'il est connecté donc
function isConnect() { 
	//si une session est déclarer et non nul et si les variables de sessions login et mdp sont déclaré et non nul également
	if (isset($_SESSION) && isset($_SESSION['loginPostForm']) && isset($_SESSION['passwordPostForm'])) {
		//on retourne vrai
		return true;
	}else {
		//sinon on retourne faux
		return false;
	}
}

// On crée une fonction qui sera appelée plusieurs fois
function secure_donnee($donnee){
    // On regarde si le type est un nombre entier
    // Pour plus de précisions sur les fonctions de base de PHP utilisées ici, rendez vous sur http://fr.php.net/
    if(ctype_digit($donnee)){
        return intval($donnee);
    }else{
        return addslashes($donnee);
    }
}

//fonction permettant de vérifier s'il y a des caractères consécutifs dans une chaine, exemple : "zzzz"
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

//fonction permettant de vérifier s'il y a des caractères alternatifs dans une chaine, exemple : "ezez"
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

//à l'affichage, les caractères du mot de passe apparaîtront comme ceci '*'
function StarPass(){
    $star ='';
    for ($i=0; $i < strlen($_SESSION['passwordPostForm']); $i++) { 
        $star.='*';
    }
    echo $star;
}

//Vérification de l'existence de $_POST
if (!isset($_POST)) {
    $erreur = true;
}

/*********** Début tests sur le pseudo1 ***********/
if(isset($_POST['pseudo1']) && $_POST['pseudo1'] != ''){    
    // On vérifie qu'il s'agit bien d'une chaine de caractères dont la longueur ne dépasse pas 15 caractères
    $longueur_chaine = strlen($_POST['pseudo1']);
    if($longueur_chaine < 8 || $longueur_chaine > 15){
        $erreur = true;
        $retour .= 'Le pseudo doit être composé de 8 caractères minimum et ne doit pas dépasser 15 caractères.<br>';
    }
    // On vérifie à l'aide d'expression régulière que la référence respecte bien la forme ABCD1234
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['pseudo1'])){
        $erreur = true;
        $retour .= 'Le pseudo saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
    }
    if (!checkConsecutiveChars($_POST['pseudo1'])) {
        $erreur = true;
        $retour .= 'Le pseudo contient des caractères consécutifs.<br>';
    }
    if (!checkAlternateChars($_POST['pseudo1'])) {
        $erreur = true;
        $retour .= 'Le pseudo contient des caractères alternatifs.<br>';
    }
}
/*********** Fin tests sur le pseudo1 ***********/

/*********** Début tests sur le mdp1 ***********/
if(isset($_POST['mdp1']) && $_POST['mdp1'] != ''){    
    // On vérifie qu'il s'agit bien d'une chaine de caractères dont la longueur ne dépasse pas 20 caractères
    $longueur_chaine = strlen($_POST['mdp1']);
    if($longueur_chaine < 8 || $longueur_chaine > 20){
        $erreur = true;
        $retour .= 'Le mot de passe doit être composé de 8 caractères minimum et ne doit pas dépasser 20 caractères.<br>';
    }
    // On vérifie à l'aide d'expression régulière que la référence respecte bien la forme ABCD1234
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['mdp1'])){
        $erreur = true;
        $retour .= 'Le mot de passe  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
    }
    if (!checkConsecutiveChars($_POST['mdp1'])) {
        $erreur = true;
        $retour .= 'Le mot de passe contient des caractères consécutifs.<br>';
    }
    if (!checkAlternateChars($_POST['mdp1'])) {
        $erreur = true;
        $retour .= 'Le mot de passe contient des caractères alternatifs.<br>';
    }
}
/*********** Fin tests sur le mdp1 ***********/

// Si les données reçues sont valides, on va les sécuriser en s'aidant de notre fonction créee au début
if(!$erreur && isset($_POST['pseudo1'],$_POST['mdp1'])){
    //on enlève les espaces avec trim et on interprête pas les balises html s'il y en a avec htmlentities
    $pseudo = htmlentities(secure_donnee(trim($_POST[ 'pseudo1' ])));
    $mdp = htmlentities(secure_donnee(trim($_POST[ 'mdp1' ])));

    // On vérifie que le pseudo existe en base de données
    $query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo=:pseudo1' );
    $query->bindParam( ':pseudo1', $pseudo);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    if(!count($row)){
        // S'il n'y a pas de résultat...
        $retour .= 'L\'utilisateur avec ce pseudo n\'existe pas.<br>';
    }else{
        //on récupère le hash correspondant au besoin pseudo associé en base de données
        $hash = $row[0]['mdp'];
        //on effectue un test de verification de mot de passe : celui que l'on à rentrer avec le hash enregistré en base de données
        if (password_verify($mdp, $hash)) {
            //on appel la fonction setConnected qui permet de connecter l'utilisateur avec en paramètres les valeurs des inputs 
			//pseudo et mdp du form de connexion stocké pour l'instant grâce à la varible globale $_POST
            //puis stocké dans les variables $pseudo et $mdp
            setConnected($pseudo, $hash);
        } else {
            $retour .= 'L\'utilisateur avec ce mot de passe n\'existe pas.<br>';
        }
    }
}

// Connection en tant qu'admin
if(isset($_POST['mdp1']) && $_POST['mdp1'] != ''){ 
    //on enlève les espaces avec trim et on interprête pas les balises html s'il y en a avec htmlentities
    $pseudo = htmlentities(secure_donnee(trim($_POST[ 'pseudo1' ])));
    $mdp = htmlentities(secure_donnee(trim($_POST[ 'mdp1' ])));
    if ($pseudo == $loginAdmin && $mdp == $mdpAdmin) {
        setConnected($loginAdmin, $mdpAdmin);
        $retour = 'Vous êtes connecté en tant qu\'admin !';
    } 
}
?>