// Verkrijg referenties naar de HTML-elementen voor keuzes en output
const computerChoice = document.getElementById("computer-choice"); // Voor de keuze van de computer
const playerChoice = document.getElementById("player-choice"); // Voor de keuze van de speler
const resultOutput = document.getElementById("result"); // Voor het resultaat van het spel

// Verkrijg alle knoppen die keuzes vertegenwoordigen (steen, papier, schaar)
const possibleChoices = document.querySelectorAll("button");

// Verkrijg de scorevelden voor speler en computer
const outputScoreComputer = document.getElementById("scoreComputer");
const scoreSpeler = document.getElementById("scoreSpeler");

// Initialiseer variabelen voor spelerkeuze, computerkeuze en het resultaat
let player; // Keuze van de speler
let computer; // Keuze van de computer
let result; // Resultaat van de huidige ronde

// Initialiseer de scores van de speler en de computer
let scorePlayer = 0; // Score van de speler
let scoreComputer = 0; // Score van de computer

// Toon de initiële scores in de scorevelden
scoreSpeler.innerHTML = " - Speler " + scorePlayer;
outputScoreComputer.innerHTML = "Computer " + scoreComputer;

// Voeg eventlisteners toe aan elke knop voor steen, papier, en schaar
possibleChoices.forEach((button) =>
  button.addEventListener("click", (e) => {
    // Wacht 1 seconde voordat de keuzes en resultaten worden bijgewerkt
    setTimeout(() => {
      player = e.target.id; // Verkrijg de id van de aangeklikte knop (keuze van de speler)
      playerChoice.innerHTML = player; // Toon de keuze van de speler
      generateComputerChoice(); // Genereer de keuze van de computer
      getResult(); // Bepaal het resultaat van de ronde
    }, 1000);
  })
);

// Functie om de keuze van de computer te genereren
function generateComputerChoice() {
  const randomNumber = Math.floor(Math.random() * 3) + 1; // Genereer een willekeurig getal tussen 1 en 3

  // Koppel het willekeurige getal aan een keuze (steen, papier of schaar)
  if (randomNumber == 1) {
    computer = "rock"; // Steen
  } else if (randomNumber == 2) {
    computer = "paper"; // Papier
  } else if (randomNumber == 3) {
    computer = "scissors"; // Schaar
  }
  computerChoice.innerHTML = computer; // Toon de keuze van de computer
}

// Functie om het resultaat van de ronde te bepalen
function getResult() {
  if (computer === player) {
    // Gelijkspel: beide kiezen hetzelfde
    result = "Gelijkspel!";
    resultOutput.style.color = "orange"; // Geef het resultaat een oranje kleur
  } else if (
    // Speler wint als:
    (computer === "rock" && player === "paper") || // Papier verslaat steen
    (computer === "paper" && player === "scissors") || // Schaar verslaat papier
    (computer === "scissors" && player === "rock") // Steen verslaat schaar
  ) {
    result = "Jij wint"; // Speler wint
    resultOutput.style.color = "green"; // Geef het resultaat een groene kleur
    scorePlayer++; // Verhoog de score van de speler
    scoreSpeler.innerHTML = " - Speler " + scorePlayer; // Werk de scoreweergave bij
    outputScoreComputer.innerHTML = "Computer " + scoreComputer; // Houd de score van de computer bij

    // Controleer of de speler 3 punten heeft gehaald (winconditie)
    if (scorePlayer === 3) {
      result = "Goed zo! Je hebt de computer verslagen.";
      resultOutput.style.color = "green"; // Groene kleur voor winst
      setTimeout(() => {
        window.location.href = "../Game Jochem/tama.php"; // Ga naar de volgende pagina
      }, 3000);
    }
  } else {
    // Computer wint
    result = "Computer wint"; 
    resultOutput.style.color = "red"; // Geef het resultaat een rode kleur
    scoreComputer++; // Verhoog de score van de computer
    scoreSpeler.innerHTML = " - Speler " + scorePlayer; // Werk de scoreweergave van de speler bij
    outputScoreComputer.innerHTML = "Computer " + scoreComputer; // Werk de scoreweergave van de computer bij

    // Controleer of de computer 3 punten heeft gehaald (verliesconditie)
    if (scoreComputer === 3) {
      result = "Helaas! De computer heeft je verslagen.";
      resultOutput.style.color = "red"; // Rode kleur voor verlies
      setTimeout(() => {
        location.reload(); // Herstart het spel
      }, 3000);
    }
  }

  // Toon het resultaat van de huidige ronde
  resultOutput.innerHTML = result;
}
