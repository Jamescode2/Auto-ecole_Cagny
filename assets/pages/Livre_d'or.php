<?php
include_once("function.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole de conduite de cagny</title>
    <link rel="shortcut icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/Livre_d'or.css">
    <script src="../js/index.js" defer></script>
    <script src="../js/Livre_d'or.js" defer></script>
    <script src="https://kit.fontawesome.com/c14c1b087e.js" crossorigin="anonymous"></script>
</head>
<body>

<header id="menu">
    <div class="logo">
        <a href="Accueil.html" target="_blank"><img src="../img/logo.jpg"
                alt="Accueil"></a>
    </div>
    <ul class="menu_li">
        <li class="lien"><a href="Accueil.html">accueil</a></li>
        <li class="lien"><a href="Présentation.html">présentation</a></li>
        <li class="lien formation">
            <a href="#">formation</a>
            <div class="dropdown">
                <a href="PermisB.html">Permis B</a>
                <a href="Accompagnee.html">Conduite accompagnée</a>
                <a href="FormationA2.html">Formation A2</a>
                <a href="FormationAM.html">Formation AM</a>
                <a href="Formation125.html">Formation 125</a>
                <a href="PasserelleA2_A.html">Passerelle A2 => A</a>
                <a href="Horsforfait.html">prestation Hors forfait</a>
            </div>
        </li>
        <li class="lien"><a href="Agence.php">agence</a></li>
        <li class="lien"><a href="Livre_d'or.php">Livre d'or</a></li>
    </ul>
    <div class="icon">
        <i class="fa fa-bars"></i>
    </div>
    <div class="menu_mobile">
        <a href="Accueil.html">accueil</a>
        <a href="Présentation.html">présentation</a>
        <a href="#" class="dropdown_formation">formation</a>
        <div class="dropdown_mobile">
            <a href="PermisB.html">
                <i class='fas fa-angle-right'></i>
                Permis B
            </a>
            <a href="Accompagnee.html">
                <i class='fas fa-angle-right'></i>
                Conduite accompagnée
            </a>
            <a href="FormationA2.html">
                <i class='fas fa-angle-right'></i>
                Formation A2
            </a>
            <a href="FormationAM.html">
                <i class='fas fa-angle-right'></i>
                Formation AM
            </a>
            <a href="Formation125.html">
                <i class='fas fa-angle-right'></i>
                Formation 125
            </a>
            <a href="PasserelleA2_A.html">
                <i class='fas fa-angle-right'></i>
                Passerelle A2 => A
            </a>
            <a href="Horsforfait.html">
                <i class='fas fa-angle-right'></i>
                prestation Hors forfait
            </a>
        </div>
        <a href="Agence.php">agence</a>
        <a href="Livre_d'or.php">Livre d'or</a>
    </div>
    </header>

<div id="carrousel">
    <div class="slide anim">
        <img src="../img/img.jpg" alt="image">
    </div>
    <div class="slide anim">
        <img src="../img/img2.jpg" alt="image">
    </div>

    <div class="slide anim">
        <img src="../img/img3.jpg" alt="image">
    </div>

    <div class="slide anim">
        <img src="../img/img4.jpg" alt="image">
    </div>

    <div class="slide anim">
        <img src="../img/img5.jpg" alt="image">
    </div>

    <div class="slide anim">
        <img src="../img/img6.jpg" alt="image">
    </div>
    <div class="slide anim">
        <img src="../img/img7.jpg" alt="image">
    </div>
    <div class="slide anim">
        <img src="../img/img8.jpg" alt="image">
    </div>
    <div class="titre">
        <h1>Ecole de conduite de Cagny</h1>
        <h2>Cagny</h2>
    </div>
    </div>



<div id="information">  
    <div id="user">
        <?php if(isConnect()) { ?>
            <button class="pseudoBtn"><a id="btnDeco" href="deco.php">Se Deconnecter</a></button>
            <button class="pseudoBtn" id="profil" onclick="openProfil()">Profil</button>
        <?php }else{ ?>
            <button class="pseudoBtn" id="inscription" onclick="openInscription()">inscription</button>
            <button class="pseudoBtn" id="connection" onclick="openConnect()">Connection</button>
        <?php } ?>
    </div>
    <div id="retour">
        <?php if (isset($_SESSION) && isset($_SESSION['retour'])): ?>
            <div class="alert alert-retour">
                <?= $_SESSION['retour'];?>
            </div>
        <?php unset($_SESSION['retour']); endif;?>
        <?php if ($retour != ''): ?>
            <div class="alert alert-retour">
                <?=$retour;?>
            </div>
        <?php endif;?>
    </div>
    <div class="divider"></div>
    <div class="agence">
        <span class="h1bis">Livre d'or </span>
        <span class="h2bis">VOUS AVEZ RÉUSSI AVEC NOUS ?</span>
        <p>Votre avis compte pour notre équipe. Partagez ici votre témoignage  !</p>
    </div>
    <div style="margin-top:50px;">
        <?php if(isConnect()) { ?>
            <button class="pseudoBtn" onclick="openCreateMessage()">Ajouter un Message</button>
        <?php } ?>
        <div id="message"></div>
    </div>
    </div>
<div id="service">
        <div class="code">
            <div class="pass">
                <span class="h2bis">S'entrainer au code sur internet ?</span>
                <p>C'EST POSSIBLE ! <br>
                    Avec le prépacode cours, prépacode test et l'appli code mobile,
                    connectez-vous et retrouvez des cours multimédias et des tests de code en illimité.</p>
                <a href="https://www.prepacode-enpc.fr/" target="_blank">PREPACODE</a>

                <span class="h2bis">Formation en ligne avec Pass Rousseau</span>
                <a href="https://auto-ecole.codesrousseau.fr/inscription/etape/inscription"
                    target="_blank">FORMATION EN
                    LIGNE</a>
            </div>

            <div class="rousseau">
                <div>
                    <span class="h2bis">Page auto-école de Cagny</span>
                    <a href="https://auto-ecole.codesrousseau.fr/annuaire-auto-ecoles/cagny/l-ecole-de-conduite-de-cagny/1143"
                        target="_blank">CAGNY</a>
                </div>
                <div>
                    <span class="h2bis">Page auto-école de IFS</span>
                    <a href="https://auto-ecole.codesrousseau.fr/annuaire-auto-ecoles/ifs/ifs/24024"
                        target="_blank">IFS</a>
                </div>
            </div>
        </div>

        <div class="slider">
            <div class="slide2 anim">
                <img src="../img/bureau.jpg" alt="image">
            </div>
            <div class="slide2 anim">
                <img src="../img/salle1.jpg" alt="image">
            </div>

            <div class="slide2 anim">
                <img src="../img/salle2.jpg" alt="image">
            </div>

            <div class="slide2 anim">
                <img src="../img/salle3.jpg" alt="image">
            </div>

            <div class="slide2 anim">
                <img src="../img/salle4.jpg" alt="image">
            </div>

            <div class="slide2 anim">
                <img src="../img/salle5.jpg" alt="image">
            </div>
        </div>
    </div>
<div id="horaire">
        <div class="divider"></div>
        <div class="disponibilite">
            <span class="h2bis">disponibilité</span>
            <p>Permanence Code et bureau du lundi au Vendredi de 18h à 19h, Samedi de 13 h à 14 h et sur rendez vous
                au
                06.45.13.84.14. <br>
                Pour la conduite prise en charge possible domicile-Ets scolaire-Ets professionnel. <br>
                Facilité de paiement possible - Modalité de paiement Chèque-Carte bancaire-Espèces.
            </p>
        </div>

        <div class="bloc">

            <div><img src="../img/logo.jpg" alt="l-ecole-de-conduite-de-cagny"></div>
            <div class="entreprise">
                <span class="h2bis"><i class='fas fa-info-circle'></i> Ecole de conduite de Cagny</span>

                <p><i class='fas fa-phone'></i> 09 64 05 02 68</p>
                <p><i class="fa fa-mobile-phone"></i> 06 45 13 84 14</p>
                <p><a href="mailto:ecoleconduitecagny@orange.fr" target="_blank"><i class='fas fa-mail-bulk'></i>
                        ecoleconduitecagny@orange.fr</a></p>
                <p><i class='fas fa-map-marker-alt'></i> 73, avenue de Paris <br>
                    14630 CAGNY <br>
                    Calvados | Basse-Normandie</p>
                <p>Agrément n°E1401400050</p>
            </div>
            <div class="horaire">
                <button class="accordion">
                    <span class="h2bis"><i class='far fa-clock'></i> HORAIRES</span>

                </button>
                <div class="panel">
                    <p>Code & Bureau :</p>
                    <p>Lundi de 18h à 19h</p>
                    <p>Mardi de 18h à 19h</p>
                    <p>Mercredi de 18h à 19h</p>
                    <p>Jeudi de 18h à 19h</p>
                    <p>Vendredi de 18h à 19h</p>
                    <p>Samedi de 13h à 14h</p>
                    <p>Dimanche Fermé</p>
                </div>
            </div>
        </div>
    </div>
<footer>

    <div class="chevron-up">
        <img src="../img/fleche.png" alt="chevron-up">
    </div>
    <h3>© l-ecole-de-conduite-de-cagny</h3>
    </footer>
<!-- Modal d'inscription -->
    <div class="modal" id="modal1">
        <div class="close"><span class="closeBtn" onclick="closeInscription()">X</span></div>
        <span class="h2bis text-center">-- Formulaire d'Inscription --</span>
        <p class="text-center">(Le mail doit comporter, entre 12 et 25 caractères, sans caractères spéciaux sauf "@")</p>
        <p class="text-center">(le Pseudo doit comporter, entre 8 et 15 caractères, sans caractères spéciaux)</p>
        <p class="text-center">(le mot de passe doit comporter, entre 8 et 20 caractères, sans caractères spéciaux)</p>
        <form class="form" action="../../utilisateur/create.php" method="post">
            <input class="pseudoTxtarea" type="text" placeholder="E-Mail" name="mail" id="mail">
            <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo" id="pseudo">
            <input class="pseudoTxtarea" type="password" placeholder="mot de passe" name="mdp" id="mdp">
            <div class="text-center">
                <input type="submit" value="S'Inscrire" class="pseudoBtn">  
            </div>
        </form>
    </div>
    
<!-- Modal de connection -->
    <div class="modal" id="modal2">
        <div class="close"><span class="closeBtn" onclick="closeConnect()">X</span></div>
        <span class="h2bis text-center">-- Formulaire de Connection --</span>
        <p class="text-center">(Le Pseudo doit comporter, entre 8 et 15 caractères, sans caractères spéciaux)</p>
        <p class="text-center">(Le mot de passe doit comporter, entre 8 et 20 caractères, sans caractères spéciaux)</p>
        <form class="form" action="Livre_d'or.php" method="post">
            <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo1">
            <input class="pseudoTxtarea" type="password" placeholder="mot de passe" name="mdp1">
            <div class="text-center">
                <input type="submit" value="Se Connecter" class="pseudoBtn">
            </div>
        </form>
    </div>
    
<!-- Modal du Profil -->
    <div class="modal" id="modal3">
        <div class="close"><span class="closeBtn" onclick="closeProfil()">X</span></div>
        <span class="h2bis text-center">-- Page du profil --</span>
        <div class="session">
            <h4>Pseudo: <?php echo $_SESSION['loginPostForm']?></h4>
            <div class="Icons">
                <img src="../img/edit.png" alt="edit" onclick="modifPseudo()">
            </div>
        </div>
        <div class="session">
            <h4>Mot de Passe: <?php StarPass() ?></h4>
            <div class="Icons">
                <img src="../img/edit.png" alt="edit" onclick="modifMdp()">
            </div>
        </div>
        <form action="../../utilisateur/destroy.php" method="post">
            <div class="text-center">
                <input name="btnDeleteAccount" type="submit" value="Supprimer son Compte" class="pseudoBtn">
            </div>
        </form>
    </div>
    
<!-- modifPseudo -->
    <div class="modal" id="modal4">
        <div class="close"><span class="closeBtn" onclick="closemodifPseudo()">X</span></div>
        <span class="h2bis text-center">-- Modification de Pseudo --</span>
        <p class="text-center">(Le Pseudo doit comporter, entre 8 et 15 caractères, sans caractères spéciaux)</p>
        <form class="form" action="../../utilisateur/update.php" method="post">
            <input class="pseudoTxtarea" type="text" placeholder="newPseudo" name="newPseudo">
            <div class="text-center">
                <input type="submit" value="modifPseudo" class="pseudoBtn">
            </div>
        </form>
    </div>
<!-- modifMdp -->
    <div class="modal" id="modal5">
        <div class="close"><span class="closeBtn" onclick="closemodifMdp()">X</span></div>
        <span class="h2bis text-center">-- Modification de mot de passe --</span>
        <p class="text-center">(Le mot de passe doit comporter, entre 8 et 20 caractères, sans caractères spéciaux)</p>
        <form class="form" action="../../utilisateur/update.php" method="post">
            <input class="pseudoTxtarea" type="password" placeholder="newMdp" name="newMdp">
            <div class="text-center">
                <input type="submit" value="modifMdp" class="pseudoBtn">
            </div>
        </form>
    </div>
<!-- fenêtre de création d'un nouveau Message -->
    <div class="modal" id="modal8">
        <div class="close"><span class="closeBtn" onclick="closeCreateMessage()">X</span></div>
        <span class="h2bis text-center">-- Ajouter un message--</span>
        <p class="text-center">(Le message doit comporter, entre 8 et 256 caractères, sans caractères spéciaux)</p>
        <form action="../../message/create.php" method="post">
            <input name="createMessage" class="pseudoTxtarea2" id="createMessage" contenteditable></input>
            <div class="text-center">
                <input type="submit" value="Ajouter le Message" class="pseudoBtn" id="CreateMessage">
            </div>
        </form>
    </div>
<!-- modifMessage -->
    <div class="modal" id="modal9">
        <div class="close"><span class="closeBtn" onclick="closemodifMessage()">X</span></div>
        <span class="h2bis text-center">-- Update Message --</span>
        <p class="text-center">(Le nouveau message doit comporter, entre 8 et 256 caractères, sans caractères spéciaux)</p>
        <form class="form" action="../../message/update.php" method="post">
            <input type="hidden" id="recupIdMessage" name="idMessage"/>
            <input class="pseudoTxtarea" type="text" placeholder="modifMessage" name="modifMessage" id="modifMessage">
            <div class="text-center">
                <input type="submit" value="Modifier le Message" class="pseudoBtn" id="UpdateMessage">
            </div>
        </form>
    </div>
<?php if(isConnect()) { ?>
        <script>
            window.onload = () => {
                let Icons = document.querySelectorAll('#message .Icons');
                let croix = document.querySelectorAll('.croix');
                for (let i=0; i < croix.length; i++) {
                    Icons[i].style.visibility = "visible"; 
                    croix[i].style.visibility = "visible"; 
                }
            };
        </script>
    <?php } ?>

</body>
</html>