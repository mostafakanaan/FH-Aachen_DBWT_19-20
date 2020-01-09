const beschreibungTab = document.getElementById("home-tab");
const zutatenTab = document.getElementById("zutaten-tab");
const bewertungenTab = document.getElementById("bewertungen-tab");

beschreibungTab.addEventListener('click', function () {
    beschreibungTab.classList.add("active");
    zutatenTab.classList.remove("active");
    bewertungenTab.classList.remove("active");

})

zutatenTab.addEventListener('click', function () {
    beschreibungTab.classList.remove("active");
    zutatenTab.classList.add("active");
    bewertungenTab.classList.remove("active");

})

bewertungenTab.addEventListener('click', function () {
    beschreibungTab.classList.remove("active");
    zutatenTab.classList.remove("active");
    bewertungenTab.classList.add("active");
})
