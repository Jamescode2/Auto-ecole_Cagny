// slider 2 possibilité
let slideIndex = 0;
showSlides();
showSlides2();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slide");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1 }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 3000);
}

function showSlides2() {
  let i;
  let slides2 = document.getElementsByClassName("slide2");
  for (i = 0; i < slides2.length; i++) {
    slides2[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides2.length) { slideIndex = 1 }
  slides2[slideIndex - 1].style.display = "block";
  setTimeout(showSlides2, 3000);
}

// accordion horaire 2 possibilité
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

// chevron-up smooth
const chevron = document.querySelector(".chevron-up");
chevron.addEventListener('click', () => {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: "smooth"
  })
})

function affiche(x,y) {
  x.addEventListener('click', () => {

    if (y.style.display === "block") {
      y.style.display = "none";
    } else {
      y.style.display = "block";
    }
  
  })
}

let formation = document.querySelector(".formation");
let dropdown = document.querySelector(".dropdown");

let burger = document.querySelector(".icon");
let menu = document.querySelector(".menu_mobile");

let formation_mobile = document.querySelector(".dropdown_formation");
let dropdown_mobile = document.querySelector(".dropdown_mobile");
// clique lien formation : affiche sous menu dropdown
affiche(formation,dropdown);
// clique burger : affiche menu-mobile
affiche(burger,menu);
// clique lien menu : affiche sous menu dropdown_mobile
affiche(formation_mobile,dropdown_mobile);



