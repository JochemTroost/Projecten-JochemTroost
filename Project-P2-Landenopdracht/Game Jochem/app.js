// Selecteer de dinosauruselement, obstakelelement, game-over-tekst, startknop en scoreweergave uit de HTML
const dinosaur = document.querySelector(".dinosaur");
const obstacle = document.querySelector(".obstacle");
const gameOverText = document.querySelector(".game-over");
const startButton = document.getElementById("start-btn");
const scoreDisplay = document.querySelector(".score");

// Voeg achtergrondmuziek toe en stel het volume in
const backgroundMusic = new Audio("background-music.mp3");
backgroundMusic.volume = 0.3; // Zet het volume van de muziek op 30%

// Initialiseer variabelen om de spelstatus bij te houden
let isJumping = false; // Houdt bij of de dinosaurus springt
let isGameOver = false; // Houdt bij of het spel voorbij is
let score = 0; // Houdt de score van de speler bij
let obstacleInterval; // Verwijzing naar de interval voor het updaten van het spel

// Voeg een eventlistener toe om het spel te starten wanneer op de startknop wordt geklikt
startButton.addEventListener("click", startGame);

// Functie om het spel te starten
function startGame() {
  isGameOver = false; // Reset de spelstatus
  score = 0; // Reset de score

  // Verberg de game-over tekst en startknop
  gameOverText.style.display = "none";
  startButton.style.display = "none";

  // Activeer de animatie van het obstakel
  obstacle.style.animation = `moveLeft 2s random infinite`;

  // Reset en toon de score
  scoreDisplay.textContent = `Score: ${score}`;

  // Start de achtergrondmuziek en herhaal deze in een loop
  backgroundMusic.loop = true;
  backgroundMusic.play();

  // Start een interval dat de game regelmatig bijwerkt
  obstacleInterval = setInterval(updateGame, 200);
}

// Voeg een eventlistener toe om te detecteren of de spatiebalk wordt ingedrukt
document.addEventListener("keydown", function (event) {
  if (event.key === " " && !isJumping && !isGameOver) {
    isJumping = true; // Markeer dat de dinosaurus aan het springen is
    dinosaur.style.animation = "jump 0.8s"; // Voeg springanimatie toe aan de dinosaurus

    // Stop de springanimatie na 0,8 seconden
    setTimeout(() => {
      dinosaur.style.animation = "none"; // Verwijder de animatie
      isJumping = false; // Markeer dat de dinosaurus niet meer springt
    }, 800);
  }
});

// Functie om te controleren of de dinosaurus het obstakel raakt
function checkCollision() {
  const dinosaurRect = dinosaur.getBoundingClientRect(); // Verkrijg de positie van de dinosaurus
  const obstacleRect = obstacle.getBoundingClientRect(); // Verkrijg de positie van het obstakel

  // Controleer op een botsing tussen de dinosaurus en het obstakel
  if (
    dinosaurRect.right > obstacleRect.left &&
    dinosaurRect.left < obstacleRect.right &&
    dinosaurRect.bottom > obstacleRect.top
  ) {
    gameIsOver(); // Als er een botsing is, eindigt het spel
  }
}

// Functie die wordt aangeroepen als het spel voorbij is
function gameIsOver() {
  isGameOver = true; // Markeer dat het spel voorbij is
  clearInterval(obstacleInterval); // Stop de interval die het spel bijwerkt
  obstacle.style.animation = "none"; // Stop de animatie van het obstakel
  gameOverText.style.display = "block"; // Toon de game-over tekst
  startButton.style.display = "block"; // Toon de startknop opnieuw

  // Toon een bericht met de score en een herstartmelding
  scoreDisplay.textContent = `Score: ${score}` + " Helaas, Probeer het opnieuw";

  // Herlaad de pagina na 2 seconden
  setTimeout(() => {
    location.reload();
  }, 2000);
}

// Functie om de spelstatus bij te werken
function updateGame() {
  if (!isGameOver) {
    score++; // Verhoog de score als het spel nog bezig is
    scoreDisplay.textContent = `Score: ${score}`; // Toon de bijgewerkte score
  }

  // Controleer of de score een bepaald punt heeft bereikt
  if (score >= 10) {
    scoreDisplay.textContent =
      `Score: ${score}` + " Goed gedaan, Blijf springen!!";

    // Als de score boven de 350 is, ga door naar de volgende pagina
    setTimeout(() => {
      window.location.href = "../Game Jochem/game.php"; // Verwijs naar een andere pagina
    }, 2000);
  }

  checkCollision(); // Controleer elke update op een botsing
}
