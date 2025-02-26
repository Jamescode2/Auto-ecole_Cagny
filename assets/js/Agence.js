/********************** Vérification taille de chaine ***************************/
/*
* Vérifie basiquement un champ renseigné par une chaine de caractères
**/
function verifChaine(type) {
    // On vérifier la longueur de la chaine de caractère renseignée
    let chaine = document.getElementById(type).value;

    if (chaine == "") {	// Si le champs n'est pas renseigné, on affiche un message d'erreur en rouge
        document.getElementById('span_' + type).innerHTML = "Non renseigné !";
        document.getElementById('span_' + type).style.color = "red";
    } else if (chaine.length < 3) {	// Si la taille est inférieure à 3 caractères, on affiche un message d'erreur en rouge
        document.getElementById('span_' + type).innerHTML = "Trop court !";
        document.getElementById('span_' + type).style.color = "red";
        return false;	// on retourne "false" pour dire que le formulaire n'est pas valide
    } else if (chaine.length > 12) { // Si la taille est supérieure à 12 caractères, on affiche un message d'erreur en rouge
        document.getElementById('span_' + type).innerHTML = "Trop long !";
        document.getElementById('span_' + type).style.color = "red";
        return false;	// on retourne "false" pour dire que le formulaire n'est pas valide
    } else { // La taille du champ est entre 3 et 12 caractères, on affiche un message en vert
        document.getElementById('span_' + type).innerHTML = "Valide";
        document.getElementById('span_' + type).style.color = "green";
        return true;	// on retourne "true" pour dire que le formulaire est valide
    }
}

function verifTel(type) {
    let tel = document.getElementById(type).value;
    if (tel == "") {
        document.getElementById('span_' + type).innerHTML = "Non renseigné !";
        document.getElementById('span_' + type).style.color = "red";
    } else if (tel.length < 10) {
        document.getElementById('span_' + type).innerHTML = "Trop court !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else if (tel.length > 10) {
        document.getElementById('span_' + type).innerHTML = "Trop long !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else if (tel.length = 10) {
        document.getElementById('span_' + type).innerHTML = "Valide";
        document.getElementById('span_' + type).style.color = "green";
        return true;
    }
}

function verifMail(type) {
    let mail = document.getElementById(type).value;
    if (mail == "") {
        document.getElementById('span_' + type).innerHTML = "Non renseigné !";
        document.getElementById('span_' + type).style.color = "red";
    } else if (mail.length < 12) {
        document.getElementById('span_' + type).innerHTML = "Trop court !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else if (mail.length > 25) {
        document.getElementById('span_' + type).innerHTML = "Trop long !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else {
        document.getElementById('span_' + type).innerHTML = "Valide";
        document.getElementById('span_' + type).style.color = "green";
        return true;
    }
}

function verifMessage(type) {
    let message = document.getElementById(type).value;
    if (message == "") {
        document.getElementById('span_' + type).innerHTML = "Non renseigné !";
        document.getElementById('span_' + type).style.color = "red";
    } else if (message.length < 8) {
        document.getElementById('span_' + type).innerHTML = "Trop court !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else if (message.length > 256) {
        document.getElementById('span_' + type).innerHTML = "Trop long !";
        document.getElementById('span_' + type).style.color = "red";
        return false;
    } else {
        document.getElementById('span_' + type).innerHTML = "Valide";
        document.getElementById('span_' + type).style.color = "green";
        return true;
    }
}
/********************** Fin Vérification taille de chaine ***************************/

// Initialisation de nos évènements déclenchant nos fonctions
document.getElementById('name').addEventListener('keyup', function () {
    verifChaine('name');
});

document.getElementById('firstname').addEventListener('keyup', function () {
    verifChaine('firstname');
});

document.getElementById('tel').addEventListener('keyup', function () {
    verifTel('tel');
});

document.getElementById('email').addEventListener('keyup', function () {
    verifMail('email');
});

document.getElementById('Objet').addEventListener('keyup', function () {
    verifMessage('Objet');
});

document.getElementById('message').addEventListener('keyup', function () {
    verifMessage('message');
});

document.getElementById('FormAJAX').addEventListener('click', verifFormulaire);

document.getElementById('nom').addEventListener('keyup', function () {
    verifChaine('nom');
});

document.getElementById('prenom').addEventListener('keyup', function () {
    verifChaine('prenom');
});

document.getElementById('mail').addEventListener('keyup', function () {
    verifMail('mail');
});

document.getElementById('Reservation').addEventListener('click', verifReservation);


//check si la chaine a des caractères consecutifs
function checkConsecutiveChars(string) {
    let lastChar = '';
    let consecutiveCount = 0;
    for (let i = 0; i < string.length; i++) {
        if (string[i] == lastChar) {
            consecutiveCount++;
            if (consecutiveCount >= 3) {
                return false;
            }
        } else {
            consecutiveCount = 1;
            lastChar = string[i];
        }
    }
    return true;
}
/********************** Conversion numéro => mois ***************************/
function numberToMonth(num) {
    const months = [
        "Janvier", "Février", "Mars", "Avril",
        "Mai", "Juin", "Juillet", "Août",
        "Septembre", "Octobre", "Novembre", "Décembre"
    ];

    if (num < 0 || num > 11) {
        return "Invalid input. Please enter a number between 0 and 11.";
    } else {
        return months[num];
    }
}
/********************** Conversion numéro => mois  ***************************/


/********************** InstanciaHTTPRtion XMLequest  ***************************/
/* 
* Instanciation XMLHTTPRequest
**/
function getRequest() {
    // On initialise la variable dans laquelle va être stockée notre objet XMLHTTPRequest
    let xhr;
    if (window.XMLHttpRequest) {
        // Nous testons par la condition précédente si la methode entre parenthèse est supportée par le navigateur.
        // Les anciennes versions d'Internet Explorer ne supportant pas cette méthode, c'est la deuxième solution qui sera utilisée
        xhr = new XMLHttpRequest();			// création de l'instance et stockage dans la variable xhr			
    } else if (window.ActiveXObject) {
        // Nous testons la conditions précédente si la methode entre parenthèse est supportée par le navigateur.
        // Les anciennes versions d'Internet Explorer ne supporte que cette méthode ActiveX 
        xhr = new ActiveXObject("Microsoft.XMLHTTP");		// création de l'instance et stockage dans la variable xhr				
    } else {
        // Si le navigateur de l'utilisateur ne supporte aucune des deux méthodes, la technologie AJAX ne peut être utilisée.
        // On affiche donc un message d'erreur et on arrête le traitement en effectuant un "return false"
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        return false;
    }
    // Si le script arrive jusqu'ici c'est que l'instanciation de l'objet XMLHTTPRequest s'est déroulée avec succès.
    // Nous retournons donc cette instanciation stockée dans la variable xhr
    return xhr;
}
/********************** Fin InstanciaHTTPRtion XMLequest  ***************************/


/********************** test formulaire  ***************************/

/*
* Vérifie le formulaire d'ajout avant traitement
**/
function verifFormulaire() {
    // Au clic d'envoi du formulaire, on relance la totalité des fonctions de vérifications
    // Si les valeurs saisies sont correctes, les fonctions nous renvoient "true".
    // A chaque erreur (return false), on remplit une variable de retour texte que nous allons afficher ensuite afin d'identifier les erreurs.
    let textRetour = "";

    let name = document.getElementById('name').value;
    // test de l'existence du nom
    if (name !== '') {
        // Verification du name
        if (!verifChaine('name')) {
            textRetour += "Le nom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le nom respecte bien la forme ABCD1234
        if (!name.match(/[a-zA-Z0-9]/)) {
            textRetour += 'Le nom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(name)) {
            textRetour += 'Le nom contient des caractères consécutifs.<br>';
        }
    } else {
        // le nom n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre nom !<br>';
    }

    let firstname = document.getElementById('firstname').value;
    // test de l'existence du prénom
    if (firstname !== '') {
        // Verification du firstname
        if (!verifChaine('firstname')) {
            textRetour += "Le prénom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le prénom respecte bien la forme ABCD1234
        if (!firstname.match(/[a-zA-Z0-9]/)) {
            textRetour += 'Le prénom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(firstname)) {
            textRetour += 'Le prénom contient des caractères consécutifs.<br>';
        }
    } else {
        // le prénom n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre prénom !<br>';
    }

    let email = document.getElementById('email').value;
    // test de l'existence du mail
    if (email !== '') {
        // Verification de email
        if (!verifMail('email')) {
            textRetour += "Le mail doit être composé de 12 caractères minimum et ne doit pas dépasser 25 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le mail respecte bien la forme ABCD1234-.@
        if (!email.match(/[a-zA-Z0-9-.]+[@]/)) {
            textRetour += 'Le mail  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre avec "@".<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(email)) {
            textRetour += 'Le mail contient des caractères consécutifs.<br>';
        }
    } else {
        // le mail n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre mail !<br>';
    }

    let tel = document.getElementById('tel').value;
    // test de l'existence du tel
    if (tel !== '') {
        // Verification de tel
        if (!verifTel('tel')) {
            textRetour += "Le tel doit être composé de 10 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le tel respecte bien la forme 123456789
        if (!tel.match(/[0-9]/)) {
            textRetour += 'Le tel saisie n\'est pas valide : il doit être composé que de chiffres.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(tel)) {
            textRetour += 'Le tel contient des caractères consécutifs.<br>';
        }
    }

    let Objet = document.getElementById('Objet').value;
    // test de l'existence du message
    if (Objet !== '') {
        // Verification de l'Objet
        if (!verifChaine('Objet')) {
            textRetour += "L\'Objet doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que l'Objet  respecte bien la forme ABCD1234
        if (!Objet.match(/[a-zA-Z0-9]/)) {
            textRetour += 'L\'Objet saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(Objet)) {
            textRetour += 'L\'Objet contient des caractères consécutifs.<br>';
        }
    } else {
        // l'Objet n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre Objet !<br>';
    }

    let message = document.getElementById('message').value;
    // test de l'existence du message
    if (message !== '') {
        // Verification de message
        if (!verifMessage('message')) {
            textRetour += "Le message doit être composé de 8 caractères minimum et ne doit pas dépasser 256 caractères.<br>";
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(message)) {
            textRetour += 'Le message contient des caractères consécutifs.<br>';
        }
    } else {
        // le message n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre message !<br>';
    }

    //le retour n'est pas vide lorsqu'il y a une erreur : il faut donc l'afficher
    if (textRetour != "") {
        document.getElementById('textEchec').style.display = "block";
        document.getElementById('textEchec').innerHTML = textRetour;
    } else {
        // Si tout est bon, on transmet à la fonction qui va créer une requête AJAX afin de transmettre les parametres à la page cible PHP
        SendFormulaire();
    }
}

/********************** SendFormulaire ***************************/
function SendFormulaire() {
    let xhr;

    // On récupère les différents parametres du formulaire en Javascript
    let name = document.getElementById('name').value;
    let firstname = document.getElementById('firstname').value;
    let tel = document.getElementById('tel').value;
    let email = document.getElementById('email').value;
    let Objet = document.getElementById('Objet').value;
    let message = document.getElementById('message').value;

    // A partir des parametres, on crée une chaine de caractères qui va nous permettre de tous les transmettre
    let data = "&name=" + name + "&firstname=" + firstname + "&tel=" + tel + "&email=" + email + "&Objet=" + Objet + "&message=" + message;

    // On crée une instance XMLHTTPRequest
    xhr = getRequest();

    // Initialisation de la variable de retour
    let reponse;

    // Nous vérifions que la fonction getRequest a parfaitement fonctionnée : si le navigateur de l'utilisateur ne supporte pas l'AJAX, 
    // cette fonction nous retourne le booléen "false".
    if (xhr != false) {
        // En utilisant la méthode .open, nous construisons un appel AJAX vers le fichier adapté
        xhr.open("POST", "../pages/contact.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Nous récupérons le contenu du fichier appelé en faisant appel à la méthode .responseText
                reponse = xhr.responseText;
            } else {
                // Puisque la communication ne s'est pas correctement déroulée (problème serveur ou page inaccessible/introuvable/etc...), nous stockons un message d'erreur dans la variable "affiche_retour"
                reponse = "Problème lors de l'appel AJAX";
            }

            //affichage du message de réussite
            document.getElementById('textSucces').style.display = "block";
            document.getElementById('textSucces').innerHTML = 'Votre message a bien été envoyé. Merci de m\'avoir contacté :)';
        };

        // Une fois l'appel construit, nous lui envoyons la requête avec la méthode .send
        xhr.send(data);
    }
}
/********************** SendFormulaire  ***************************/

/********************** Fin test formulaire  ***************************/


/********************** test reservation  ***************************/

/*
* Vérifie la reservation avant traitement
**/
function verifReservation() {
    // Au clic d'envoi du formulaire, on relance la totalité des fonctions de vérifications
    // Si les valeurs saisies sont correctes, les fonctions nous renvoient "true".
    // A chaque erreur (return false), on remplit une variable de retour texte que nous allons afficher ensuite afin d'identifier les erreurs.
    let textRetour = "";

    let nom = document.getElementById('nom').value;
    // test de l'existence du nom
    if (nom !== '') {
        // Verification du nom
        if (!verifChaine('nom')) {
            textRetour += "Le nom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le nom respecte bien la forme ABCD1234
        if (!nom.match(/[a-zA-Z0-9]/)) {
            textRetour += 'Le nom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(nom)) {
            textRetour += 'Le nom contient des caractères consécutifs.<br>';
        }
    } else {
        // le nom n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre nom !<br>';
    }

    let prenom = document.getElementById('prenom').value;
    // test de l'existence du prénom
    if (prenom !== '') {
        // Verification du prénom
        if (!verifChaine('prenom')) {
            textRetour += "Le prénom doit être composé de 3 caractères minimum et ne doit pas dépasser 12 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le prénom respecte bien la forme ABCD1234
        if (!prenom.match(/[a-zA-Z0-9]/)) {
            textRetour += 'Le prénom saisie n\'est pas valide : il doit être composé que de chiffres et de lettre.<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(prenom)) {
            textRetour += 'Le prénom contient des caractères consécutifs.<br>';
        }
    } else {
        // le prénom n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre prénom !<br>';
    }

    let mail = document.getElementById('mail').value;
    // test de l'existence du mail
    if (mail !== '') {
        // Verification de mail
        if (!verifMail('mail')) {
            textRetour += "Le mail doit être composé de 12 caractères minimum et ne doit pas dépasser 25 caractères.<br>";
        }
        // On vérifie à l'aide d'expression régulière que le mail respecte bien la forme ABCD1234-.@
        if (!mail.match(/[a-zA-Z0-9-.]+[@]/)) {
            textRetour += 'Le mail  saisie n\'est pas valide : il doit être composé que de chiffres et de lettre avec "@".<br>';
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(mail)) {
            textRetour += 'Le mail contient des caractères consécutifs.<br>';
        }
    } else {
        // le mail n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre mail !<br>';
    }

    let DateReservation = document.getElementById('DateReservation').value;
    let FinDateReservation = document.getElementById('FinDateReservation').value;
    let today = new Date();
    // test de l'existence de la date de reservation
    if (DateReservation && FinDateReservation) {
        if (new Date(DateReservation) <= today) {
            textRetour += "La date de réservation doit être supérieure à la date d'aujourd'hui.<br>";
        }
        if (new Date(FinDateReservation) <= today) {
            textRetour += "La date de réservation doit être supérieure à la date d'aujourd'hui.<br>";
        }
        if (new Date(FinDateReservation).getHours() <= new Date(DateReservation).getHours()) {
            textRetour += "La seconde date de réservation doit être supérieure à la première.<br>";
        }
    } else {
        // le date de réservation n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre date !<br>';
    }

    let msg = document.getElementById('msg').value;
    // test de l'existence du message
    if (msg !== '') {
        // Verification de message
        if (!verifMessage('msg')) {
            textRetour += "Le message doit être composé de 8 caractères minimum et ne doit pas dépasser 256 caractères.<br>";
        }
        //check si la chaine a des caractères consecutifs
        if (!checkConsecutiveChars(msg)) {
            textRetour += 'Le message contient des caractères consécutifs.<br>';
        }
    } else {
        // le message n'existe pas
        textRetour += 'Vous n\'avez pas tapez votre message !<br>';
    }

    //le retour n'est pas vide lorsqu'il y a une erreur : il faut donc l'afficher
    if (textRetour != "") {
        document.getElementById('ReservationEchec').style.display = "block";
        document.getElementById('ReservationEchec').innerHTML = textRetour;
    } else {
        // Si tout est bon, on transmet à la fonction qui va créer une requête AJAX afin de transmettre les parametres à la page cible PHP
        SendReservation();
    }
}

/********************** SendReservation ***************************/
function SendReservation() {
    let xhr;

    // On récupère les différents parametres du formulaire en Javascript
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let mail = document.getElementById('mail').value;
    let DateReservation = document.getElementById('DateReservation').value;
    let FinDateReservation = document.getElementById('FinDateReservation').value;
    let msg = document.getElementById('msg').value;

    //les formats de la date de reservation 
    let date = new Date(DateReservation);
    let jourMois = date.getDate();
    let mois = numberToMonth(date.getMonth());
    let annee = date.getFullYear();
    let heure = date.getHours();
    let minute = date.getMinutes();
    date = jourMois + ' ' + mois +' ' +annee+' à '+heure+'h'+minute;

    //les formats de la date de reservation 
    let date2 = new Date(FinDateReservation);
    let jourMois2 = date2.getDate();
    let mois2 = numberToMonth(date2.getMonth());
    let annee2 = date2.getFullYear();
    let heure2 = date2.getHours();
    let minute2 = date2.getMinutes();
    date2 = jourMois2 + ' ' + mois2 +' ' +annee2+' à '+heure2+'h'+minute2;

    // A partir des parametres, on crée une chaine de caractères qui va nous permettre de tous les transmettre
    let data = "&nom=" + nom + "&prenom=" + prenom + "&mail=" + mail + "&DateReservation=" + date + "&FinDateReservation=" + date2 + "&msg=" + msg;
    
    // On crée une instance XMLHTTPRequest
    xhr = getRequest();

    // Initialisation de la variable de retour
    let reponse;

    // Nous vérifions que la fonction getRequest a parfaitement fonctionnée : si le navigateur de l'utilisateur ne supporte pas l'AJAX, 
    // cette fonction nous retourne le booléen "false".
    if (xhr != false) {
        // En utilisant la méthode .open, nous construisons un appel AJAX vers le fichier adapté
        xhr.open("POST", "../pages/reservation.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Nous récupérons le contenu du fichier appelé en faisant appel à la méthode .responseText
                reponse = xhr.responseText;
            } else {
                // Puisque la communication ne s'est pas correctement déroulée (problème serveur ou page inaccessible/introuvable/etc...), nous stockons un message d'erreur dans la variable "affiche_retour"
                reponse = "Problème lors de l'appel AJAX";
            }

            //affichage du message de réussite
            document.getElementById('ReservationSucces').style.display = "block";
            document.getElementById('ReservationSucces').innerHTML = 'Votre demande de reservation a bien été envoyé. Nous vous recontacterons par mail pour validation :)';
        };

        // Une fois l'appel construit, nous lui envoyons la requête avec la méthode .send
        xhr.send(data);
    }
}
/********************** SendReservation  ***************************/

/********************** Fin test reservation  ***************************/
