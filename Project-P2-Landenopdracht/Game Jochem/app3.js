// **Initialisatie van de eigenschappen van Tamagotchi**
let hunger = 100; // Startwaarde van de hongerbalk
let energy = 100; // Startwaarde van de energiebalk
let happiness = 100; // Startwaarde van de geluksbalk

// **Kopieerwaarden voor de balken (voor visuele updates)**
let hungerBar = hunger;
let energyBar = energy;
let happinessBar = happiness;

// **Referenties naar de voortgangsbalken in de HTML**
let outputBarHunger = document.getElementById("hungerBar"); // Balk voor honger
let outputBarEnergy = document.getElementById("energyBar"); // Balk voor energie
let outputBarHappiness = document.getElementById("happinessBar"); // Balk voor geluk

// **Referenties naar numerieke weergave van waarden**
let outputHunger = document.getElementById("outputHunger");
let outputEnergy = document.getElementById("outputEnergy");
let outputHappiness = document.getElementById("outputHappiness");

// **Knoppen voor interacties**
let buttonFeed = document.getElementById("feed"); // Knop om te voeren
let buttonSleep = document.getElementById("sleep"); // Knop om te slapen
let buttonPlay = document.getElementById("play"); // Knop om te spelen

// **Elementen voor timer en status**
let timerOutput = document.getElementById("timer");
let statusOutput = document.getElementById("status"); // Status van interacties
let statusMessage = document.getElementById("statusMessage"); // Status van Tamagotchi
let score = 0; // Aantal interacties

// **Beginstatus van Tamagotchi**
statusMessage.innerHTML = "Tamagotchi is gelukkig!";

// **Functie om het spel bij te werken**
function updateGame() {
  if (hunger <= 0 && energy <= 0 && happiness <= 0) {
    // Wanneer alle waarden 0 zijn, is Tamagotchi overleden
    statusMessage.innerHTML = "Helaas :( <br> Je Tamagotchi is overleden.";
  } else {
    // Werk de waarden in de HTML bij
    outputHunger.innerHTML = hunger;
    outputEnergy.innerHTML = energy;
    outputHappiness.innerHTML = happiness;
  }
}
setInterval(updateGame, 100); // Controleer elke 100ms

// **Update statusbericht op basis van waarden**
function updateGame1() {
  if (hunger > 0 && energy > 0 && happiness > 0) {
    statusMessage.innerHTML = "Tamagotchi is gelukkig!";
  }
}
setInterval(updateGame1, 2000); // Update elke 2 seconden

// **Functie voor voeren**
buttonFeed.addEventListener("click", function () {
  if (hunger < 100) {
    hunger = Math.max(hunger + 1); // Verhoog hongerwaarde
    hungerBar = Math.max(hungerBar + 1); // Werk balk bij
    outputBarHunger.style.width = hungerBar + "%"; // Update visuele balk
    score++; // Verhoog interactiescore
    statusOutput.innerHTML = score + " interactie's gemaakt";

    // Controleer op winstconditie
    if (score >= 120) {
      statusOutput.style.color = "green";
      statusOutput.innerHTML = "Je hebt gewonnen";
      setTimeout(() => {
        location.href = "../PHP code/end.php"; // Ga naar eindscherm
      }, 3000);
    }

    statusMessage.innerHTML = "Tamagotchi gevoed!";
  } else {
    statusMessage.innerHTML = "Tamagotchi heeft geen honger.";
  }
});

// **Functie voor spelen**
buttonPlay.addEventListener("click", function () {
  if (happiness < 100) {
    happiness = Math.max(happiness + 1); // Verhoog gelukswaarde
    happinessBar = Math.max(happinessBar + 1); // Werk balk bij
    outputBarHappiness.style.width = happinessBar + "%"; // Update visuele balk
    score++; // Verhoog interactiescore
    statusOutput.innerHTML = score + " interactie's gemaakt";

    // Controleer op winstconditie
    if (score >= 120) {
      statusOutput.style.color = "green";
      statusOutput.innerHTML = "Je hebt gewonnen";
      setTimeout(() => {
        location.href = "../PHP code/end.php"; // Ga naar eindscherm
      }, 3000);
    }

    statusMessage.innerHTML = "Tamagotchi speelt!";
  } else {
    statusMessage.innerHTML = "Tamagotchi wil niet spelen.";
  }
});

// **Functie voor slapen**
buttonSleep.addEventListener("click", function () {
  if (energy < 100) {
    energy = Math.max(energy + 3); // Verhoog energiewaarde
    energyBar = Math.max(energyBar + 3); // Werk balk bij
    outputBarEnergy.style.width = energyBar + "%"; // Update visuele balk
    score++; // Verhoog interactiescore
    statusOutput.innerHTML = score + " interactie's gemaakt";

    // Controleer op winstconditie
    if (score >= 120) {
      statusOutput.style.color = "green";
      statusOutput.innerHTML = "Je hebt gewonnen";
      setTimeout(() => {
        location.href = "../PHP code/end.php"; // Ga naar eindscherm
      }, 3000);
    }

    statusMessage.innerHTML = "Tamagotchi gaat slapen!";
  } else {
    statusMessage.innerHTML = "Tamagotchi is niet moe.";
  }
});

// **Automatische vermindering van honger**
function hungerloop() {
  hunger = Math.max(hunger - 2, 0); // Verminder hongerwaarde
  hungerBar = Math.max(hungerBar - 2, 0); // Werk balk bij
  outputBarHunger.style.width = hungerBar + "%"; // Update visuele balk
  outputHunger.innerHTML = hunger; // Update numerieke waarde
}
setInterval(hungerloop, 3000); // Elke 3 seconden

// **Automatische vermindering van energie**
function energyloop() {
  energy = Math.max(energy - 3, 0); // Verminder energiewaarde
  energyBar = Math.max(energyBar - 3, 0); // Werk balk bij
  outputBarEnergy.style.width = energyBar + "%"; // Update visuele balk
  outputEnergy.innerHTML = energy; // Update numerieke waarde
}
setInterval(energyloop, 5000); // Elke 5 seconden

// **Automatische vermindering van geluk**
function happinessloop() {
  happiness = Math.max(happiness - 2, 0); // Verminder gelukswaarde
  happinessBar = Math.max(happinessBar - 2, 0); // Werk balk bij
  outputBarHappiness.style.width = happinessBar + "%"; // Update visuele balk
  outputHappiness.innerHTML = happiness; // Update numerieke waarde
}
setInterval(happinessloop, 3000); // Elke 3 seconden
