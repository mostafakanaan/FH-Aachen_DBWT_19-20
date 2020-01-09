const beschreibungTab = document.getElementById("home-tab");
const zutatenTab = document.getElementById("zutaten-tab");
const bewertungenTab = document.getElementById("bewertungen-tab");
const beschreibungCont = document.getElementById("beschreibung");
const zutatenCont = document.getElementById("zutaten");
const bewertungenCont = document.getElementById("bewertungen");



beschreibungTab.addEventListener('click', function () {
    beschreibungTab.classList.add("active");
    zutatenTab.classList.remove("active");
    bewertungenTab.classList.remove("active");
    beschreibungCont.classList.add("active");
    zutatenCont.classList.remove("active");
    bewertungenCont.classList.remove("active");

})

zutatenTab.addEventListener('click', function () {
    beschreibungTab.classList.remove("active");
    zutatenTab.classList.add("active");
    bewertungenTab.classList.remove("active");
    beschreibungCont.classList.remove("active");
    bewertungenCont.classList.remove("active");
    zutatenCont.classList.add("active");
})

bewertungenTab.addEventListener('click', function () {
    beschreibungTab.classList.remove("active");
    zutatenTab.classList.remove("active");
    bewertungenTab.classList.add("active");
    zutatenCont.classList.remove("active");
    beschreibungCont.classList.remove("active");
    bewertungenCont.classList.add("active");
})

