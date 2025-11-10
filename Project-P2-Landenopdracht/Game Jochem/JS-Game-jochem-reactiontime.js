// **Selecteer HTML-elementen**
const reactionDisplay = document.querySelector("reactionTime"); // Reactietijd weergave
const button = document.getElementById("start-btn"); // Startknop
const gameBox = document.getElementById("gameBox"); // Speelvak
const showTime = document.getElementById("reactionTime"); // Reactietijd output
const showOutput = document.getElementById("output"); // Extra output sectie

// **Event listener voor de startknop**
button.addEventListener("click", function () {
  gameBox.style.backgroundColor = "rgba(200, 8, 8, 1)"; // Verander kleur naar rood
  randomTimeout(); // Start het spel met een willekeurige vertraging
});

// **Genereer willekeurige wachttijd en start de game**
function randomTimeout() {
  function getRandomInt(min, max) {
    // Genereer een willekeurig getal tussen min en max
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  let randomNumber = getRandomInt(2000, 7000); // Tussen 2 en 7 seconden

  setTimeout(() => {
    endGame(); // Start het einde van het spel na de willekeurige wachttijd
  }, randomNumber);
}

// **Einde van het spel: Reactietijd meten**
function endGame() {
  let start = Date.now(); // Starttijd wordt vastgelegd
  gameBox.style.backgroundColor = "rgba(50, 190, 37, 1)"; // Verander kleur naar groen (startsignaal)

  // **Event listener op het speelvak**
  gameBox.addEventListener("click", function () {
    let eind = Date.now(); // Eindtijd wordt vastgelegd

    gameBox.style.backgroundColor = "rgba(23, 129, 179, 255)"; // Verander kleur naar blauw (reset)

    let reactionTime = eind - start; // Bereken reactietijd
    if (reactionTime <= 300) {
      // **Level 1 voltooid**
      showTime.innerText =
        `${reactionTime} Ms - Goed gedaan! Je hebt level 1 voltooid.`;
      setTimeout(() => {
        window.location.href = "../Game Jochem/dino.php"; // Ga naar het volgende level
      }, 2000);
    } else {
      // **Te langzaam**
      showTime.innerText =
        `${reactionTime} Ms - Helaas, te langzaam. Probeer opnieuw.`;
      setTimeout(() => {
        location.reload(); // Herlaad de pagina om opnieuw te starten
      }, 2000);
    }
  });
}
