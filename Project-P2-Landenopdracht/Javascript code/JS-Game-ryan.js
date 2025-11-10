// Haal de canvas en context op om te tekenen
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

// Stel de afmetingen van de canvas in
canvas.width = 800;
canvas.height = 400;

// Spelerobject met eigenschappen zoals positie, grootte, snelheid, enz.
let player = {
  x: 50,
  y: canvas.height - 70,
  width: 50,
  height: 50,
  color: "blue",
  speed: 5,
  bullets: [] // Array voor de schoten van de speler
};

// Array voor de vijanden
let enemies = [];
// Object om bij te houden welke toetsen ingedrukt worden
let keys = {};
// Score van het spel
let score = 0;
// Variabele voor game-overstatus
let gameOver = false;
// Tijd van het laatste schot
let lastShotTime = 0;

// Functie om de speler te tekenen
function drawPlayer() {
  ctx.fillStyle = player.color; // Stel de kleur van de speler in
  ctx.fillRect(player.x, player.y, player.width, player.height); // Teken de speler
}

// Functie om de vijanden te tekenen
function drawEnemies() {
  enemies.forEach(enemy => {
    ctx.fillStyle = "red"; // Stel de kleur van de vijand in
    ctx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height); // Teken de vijand
  });
}

// Functie om de schoten van de speler te tekenen
function drawBullets() {
  player.bullets.forEach(bullet => {
    ctx.fillStyle = "yellow"; // Stel de kleur van de kogel in
    ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height); // Teken de kogel
  });
}

// Functie om de speler te bewegen op basis van ingedrukte toetsen
function movePlayer() {
  if (keys["d"]) player.x += player.speed; // Beweeg naar rechts
  if (keys["a"]) player.x -= player.speed; // Beweeg naar links
  if (keys["w"]) player.y -= player.speed; // Beweeg omhoog
  if (keys["s"]) player.y += player.speed; // Beweeg omlaag

  // Zorg ervoor dat de speler niet buiten het canvas beweegt
  player.x = Math.max(0, Math.min(canvas.width - player.width, player.x));
  player.y = Math.max(0, Math.min(canvas.height - player.height, player.y));
}

// Functie om een schot te schieten
function shootBullet() {
  let currentTime = Date.now();
  if (currentTime - lastShotTime >= 600) { // Schiet alleen als er 600ms voorbij zijn
    player.bullets.push({
      x: player.x + player.width,
      y: player.y + player.height / 2,
      width: 10,
      height: 5,
      speed: 8 // Snelheid van de kogel
    });
    lastShotTime = currentTime; // Update de tijd van het laatste schot
  }
}

// Functie om de schoten te updaten (bewegen en verwijderen als ze uit het scherm gaan)
function updateBullets() {
  player.bullets.forEach((bullet, index) => {
    bullet.x += bullet.speed; // Beweeg de kogel naar rechts

    // Verwijder de kogel als deze buiten het scherm is
    if (bullet.x > canvas.width) {
      player.bullets.splice(index, 1);
    }
  });
}

// Functie om vijanden te spawnen
function spawnEnemies() {
  if (Math.random() < 0.05) { // 5% kans om een nieuwe vijand te spawnen
    let randomSpeedX = Math.random() * 2 + 1; // Willekeurige snelheid in de x-richting
    let randomSpeedY = (Math.random() * 2 - 1) * 2; // Willekeurige snelheid in de y-richting

    // Voeg een nieuwe vijand toe aan de array van vijanden
    enemies.push({
      x: canvas.width,
      y: Math.random() * (canvas.height - 50),
      width: 50,
      height: 50,
      speedX: randomSpeedX,
      speedY: randomSpeedY
    });
  }
}

// Functie om de vijanden te verplaatsen
function moveEnemies() {
  enemies.forEach((enemy, index) => {
    enemy.x -= enemy.speedX; // Beweeg de vijand naar links
    enemy.y += enemy.speedY; // Beweeg de vijand op en neer

    // Als de vijand de boven- of onderkant van het canvas raakt, verander de richting
    if (enemy.y < 0 || enemy.y + enemy.height > canvas.height) {
      enemy.speedY *= -1;
    }

    // Verwijder de vijand als deze buiten het scherm is
    if (enemy.x + enemy.width < 0) {
      enemies.splice(index, 1);
    }
  });
}

// Functie om botsingen te controleren tussen kogels, vijanden en de speler
function checkCollisions() {
  // Controleer botsingen tussen kogels en vijanden
  player.bullets.forEach((bullet, bIndex) => {
    enemies.forEach((enemy, eIndex) => {
      if (
        bullet.x < enemy.x + enemy.width &&
        bullet.x + bullet.width > enemy.x &&
        bullet.y < enemy.y + enemy.height &&
        bullet.y + bullet.height > enemy.y
      ) {
        // Verwijder kogel en vijand bij botsing
        player.bullets.splice(bIndex, 1);
        enemies.splice(eIndex, 1);
        score += 1; // Verhoog de score
      }
    });
  });

  // Controleer botsingen tussen de speler en de vijanden
  enemies.forEach((enemy, eIndex) => {
    if (
      player.x < enemy.x + enemy.width &&
      player.x + player.width > enemy.x &&
      player.y < enemy.y + enemy.height &&
      player.y + player.height > enemy.y
    ) {
      gameOver = true; // Zet gameOver op true als de speler botst met een vijand
      stopGame();
    }
  });
}

// Functie om de score te tekenen
function drawScore() {
  ctx.fillStyle = "white";
  ctx.font = "20px Arial";
  ctx.fillText(`Score: ${score}`, 10, 20); // Teken de score in de hoek
}

// Functie om de game-over tekst te tekenen
function drawGameOver() {
  ctx.fillStyle = "rgba(0, 0, 0, 0.5)"; // Transparente achtergrond voor game over
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  
  ctx.fillStyle = "white";
  ctx.font = "30px Arial";
  ctx.fillText("GAME OVER", canvas.width / 2 - 100, canvas.height / 2 - 40); // Teken GAME OVER tekst
  ctx.font = "20px Arial";
  ctx.fillText(`Score: ${score}`, canvas.width / 2 - 50, canvas.height / 2); // Teken de score
  ctx.fillText("Press 'R' to Restart", canvas.width / 2 - 80, canvas.height / 2 + 40); // Instructie om opnieuw te starten
}

// Functie om het spel te stoppen (animatie stoppen)
function stopGame() {
  cancelAnimationFrame(animationId); // Stop de animatie
}

// Functie om het spel opnieuw te starten
function restartGame() {
  // Reset speler, vijanden, score en game-overstatus
  player = {
    x: 50,
    y: canvas.height - 70,
    width: 50,
    height: 50,
    color: "blue",
    speed: 5,
    bullets: []
  };
  
  enemies = [];
  score = 0;
  gameOver = false;
  lastShotTime = 0;
  gameLoop(); // Start het spel opnieuw
}

// Hoofdfunctie die elke frame opnieuw wordt uitgevoerd
function gameLoop() {
  ctx.clearRect(0, 0, canvas.width, canvas.height); // Wis het canvas

  if (gameOver) {
    drawGameOver(); // Teken game-over scherm
    return;
  }

  // Update en teken alle onderdelen van het spel
  movePlayer();
  updateBullets();
  spawnEnemies();
  moveEnemies();
  checkCollisions();

  drawPlayer();
  drawBullets();
  drawEnemies();
  drawScore();

  animationId = requestAnimationFrame(gameLoop); // Vraag de volgende frame aan
}

// Event listener voor toetsinvoer (om beweging en schieten te regelen)
window.addEventListener('keydown', (e) => {
  keys[e.key] = true; // Zet de sleutelstatus op ingedrukt
  if (e.key === ' ') {
    shootBullet(); // Schiet een kogel als de spatiebalk wordt ingedrukt
  }
  if (e.key === 'r' && gameOver) {
    restartGame(); // Start het spel opnieuw als de speler op 'r' drukt na game-over
  }
});

// Event listener voor toetsinvoer (om beweging te stoppen wanneer de toets wordt losgelaten)
window.addEventListener('keyup', (e) => {
  keys[e.key] = false; // Zet de sleutelstatus op losgelaten
});

// Start het spel.
let animationId = requestAnimationFrame(gameLoop);
