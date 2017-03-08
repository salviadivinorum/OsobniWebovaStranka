
// tento JS pouze vyskroluje okno k vysledne chybe/uspechu po odeslani e-mailu
// z formulare kontaktform.php.
// Tento JS spousti udalost onload na tagu <body></body>

function presun() {

    var chybicka = document.getElementById("chyba");
    chybicka.scrollIntoView();
}