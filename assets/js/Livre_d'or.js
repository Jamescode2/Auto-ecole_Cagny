/********************** modal et AJAX   ***************************/

function openInscription() {
  document.getElementById("modal1").style.display = "flex";
}
function closeInscription() {
  document.getElementById("modal1").style.display = "none";
}

function openConnect() {
  document.getElementById("modal2").style.display = "flex";
}
function closeConnect() {
  document.getElementById("modal2").style.display = "none";
}

function openProfil() {
  document.getElementById("modal3").style.display = "flex";
}
function closeProfil() {
  document.getElementById("modal3").style.display = "none";
}

function modifPseudo() {
  document.getElementById("modal4").style.display = "flex";
}
function closemodifPseudo() {
  document.getElementById("modal4").style.display = "none";
}
function modifMdp() {
  document.getElementById("modal5").style.display = "flex";
}
function closemodifMdp() {
  document.getElementById("modal5").style.display = "none";
}
function openCreateMessage() {
  document.getElementById("modal8").style.display = "flex";
}
function closeCreateMessage() {
  document.getElementById("modal8").style.display = "none";
}
function closemodifMessage(){
  document.getElementById("modal9").style.display = "none";
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
function getRequest() {
  var xhr;
  if (window.XMLHttpRequest) {
      xhr = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
      alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
      return false;
  }

  return xhr;
}

/********************** affiche les messages ***************************/
document.addEventListener("DOMContentLoaded", function () {
  function EzMessageLigne(ezJson) {
    let date = new Date(ezJson.date);
    let jourMois = date.getDate();
    let mois = date.getMonth();
    let annee = date.getFullYear();
    return '<div id="'+ezJson.id+'" style="border-bottom:1px #FF8ACC solid;">'+
              '<div><strong>'+ezJson.pseudo+ '</strong> a écrit le ' +jourMois+' '+numberToMonth(mois)+' '+annee+'</div>'+
              '<div style="display:flex;justify-content:space-between;">'+
              '<div class="Icons"><img src="../img/edit.png" alt="editMessage" onclick=\'modifMessage('+ezJson.id+')\'></div>'+
              '<div class="msg">'+ezJson.msg+'</div>'+
              '<div class="croix" ><img src="../img/delete.png" alt="deleteMessage" onclick="deleteMessage('+ezJson.id+')"></div>'+
              '</div>'+
            '</div>';
  }
  
  function EzMessage(ezJson){
      var html="";
      for (var i=0;i<ezJson.length;i++) {
          html+=EzMessageLigne(ezJson[i]);
      }
      return html;
  }

  var xhr;
  xhr = getRequest();
  var reponse;
  var json;
  if (xhr != false) {
      xhr.open("POST", "../../message/show.php", true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              reponse = xhr.responseText;
              json = JSON.parse(reponse);
              let htmlStr=EzMessage(json);
              document.getElementById("message").innerHTML=htmlStr;
          } else {
              reponse = "Problème lors de l'appel AJAX";
          }
      };
      xhr.send();
  }
});
/********************** Fin d'affichage des messages ***************************/

//ouvrir modal + stocker les valeurs de l'id et du contenu de la ligne
function modifMessage(id){
  document.getElementById("modal9").style.display = "flex";
  document.getElementById("recupIdMessage").value=id;   
}

/********************** delete message ***************************/
function deleteMessage(id){
  var xhr;
  let data = "&id="+id;		
  xhr = getRequest();
  var reponse;
  if (xhr != false) {
      xhr.open("POST", "../../message/destroy.php", true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              reponse = xhr.responseText;
              let child = document.getElementById(id);
              child.parentNode.removeChild(child);
          } else {
              reponse = "Problème lors de l'appel AJAX";
          }
      };
      xhr.send(data);
  }
}
/********************** Fin delete message ***************************/

