let room1 = document.getElementById("room1");
let room1JasnaPasje = document.getElementById("room1JasnaPasje");
let room1Blood = document.getElementById("room1Blood");
let computerScreen = document.getElementById("computerScreen");
let touchPadDiv = document.getElementById("touchPadDiv");
let room1Kast = document.getElementById("room1Kast");
let room1NotitieRo = document.getElementById("room1NotitieRo");

room1JasnaPasje.addEventListener("click", function () {
  room1.src = "../../Project-p3-Escaperoom/Styling/img/jasna_pasje.png";
});

room1Blood.addEventListener("click", function () {
  room1.src = "../../Project-p3-Escaperoom/Styling/img/dnalogobloed.png";
});

computerScreen.addEventListener("click", function () {
  window.location.href =
    "../../Project-p3-Escaperoom/php_code/computerScreen.php";
});

room1.addEventListener("click", function () {
  room1.src = "../../Project-p3-Escaperoom/Styling/img/room1.jpeg";
});

touchPadDiv.addEventListener("click", function () {
  window.location.href = "../../Project-p3-Escaperoom/php_code/touchpad.php";
});

room1Kast.addEventListener("click", function () {
  window.location.href =
    "../../Project-p3-Escaperoom/php_code/touchpadKast.php";
});

room1NotitieRo.addEventListener("click", function () {
  room1.src = "../../Project-p3-Escaperoom/Styling/img/notitieRodrique.png";
});


let remainingTime = 30 * 60;

function checkLogin() {
  const passwordInput = document.getElementById("password").value;
  const correctPassword = "32212008";
  const loginMessage = document.getElementById("loginMessage");

  loginMessage.textContent = "";
  loginMessage.className = "message";

  if (passwordInput === "") {
    loginMessage.textContent = "Voer een wachtwoord in!";
    loginMessage.classList.add("error");
    return;
  }

  if (passwordInput === correctPassword) {
    loginMessage.textContent = "Inloggen geslaagd! ";
    loginMessage.classList.add("success");

    setTimeout(() => {
      window.location.href = "rooms.php";
    }, 1000);
  } else {
    loginMessage.textContent = "Fout wachtwoord, probeer opnieuw!";
    loginMessage.classList.add("error");
  }
}

function goBack() {
  window.location.href = "../index.php";
}

function addNumber(num) {
  let inputField = document.getElementById("codeInput");

  if (inputField.value.length < 4) {
    inputField.value += num;
  }
}

function clearInput() {
  document.getElementById("codeInput").value = "";
}

function checkCode() {
  let code = document.getElementById("codeInput").value;
  if (code === "2005") {
    window.location.href = "room2.php";
  } else {
    window.location.href = "touchpad.php";
    clearInput();
  }
}

  



function login() {
  const medewerkersnummer = document.getElementById("medewerkersnummer").value;
  const loginMessage = document.getElementById("loginMessage");

  loginMessage.textContent = "";
  loginMessage.className = "message";

  if (medewerkersnummer === "") {
    loginMessage.textContent = "Vul alstublieft uw medewerkersnummer in.";
    loginMessage.classList.add("error");
    return;
  }

  if (medewerkersnummer === "03585429") {
    loginMessage.textContent = "Inloggen geslaagd! Welkom Jasna.";
    loginMessage.classList.add("success");

    setTimeout(() => {
      document.querySelector(".login-container").classList.remove("active");
      document.querySelector(".menu-container").classList.add("active");
    }, 1000);
  } else if (medewerkersnummer === "000350") {
    loginMessage.textContent = "Inloggen geslaagd! Welkom Jochem.";
    loginMessage.classList.add("success");

    setTimeout(() => {
      window.location.href = "../../Project-p3-Escaperoom/php_code/systeem/master.php";
    }, 1000);
  } else {
    loginMessage.textContent = "Ongeldig medewerkersnummer. Probeer opnieuw.";
    loginMessage.classList.add("error");
  }
}

function search() {
const searchName = document
  .getElementById("searchName")
  .value.trim()
  .toLowerCase();
const searchResults = document.getElementById("searchResults");

searchResults.innerHTML = "";

if (searchName === "rodrique friedrich") {

  searchResults.innerHTML = `
    <p>Zoeken geslaagd. 1 Persoon gevonden</p>
    <p><strong>★</strong></p>
    <p><strong>Naam:</strong> Rodrique Friedrich</p>
    <p><strong>Leeftijd:</strong> 32</p>
    <p><strong>Geboortejaar:</strong> 1993</p>
    <p><strong>Opgenomen als:</strong> patiënt met psychische problemen</p>
    <p><strong>Status:</strong> Vermist</p>
    <p><strong>DNA Code:</strong> 099046276</p>
    <p><strong>Foto:</strong> Geen foto beschikbaar</p>


  `;
} else if (searchName === "jasna weber") {
  loginMessage.textContent = "Zoeken geslaagd. 1 Persoon gevonden";
  searchResults.innerHTML = `
    <p>Zoeken geslaagd. 1 Persoon gevonden</p>
    <p><strong>★</strong></p>
    <p><strong>Naam:</strong> Jasna Weber</p>
    <p><strong>Persn:</strong> 03585429</p>
    <p><strong>Leeftijd:</strong> 20</p>
    <p><strong>Geboortejaar:</strong> 2005</p>
    <p><strong>Aangenomen als:</strong> Arts</p>
    <p><strong>DNA Code:</strong> 099042316</p>
    <p><strong>Foto:</strong></p>
    <img src="../../Project-p3-Escaperoom/Styling/img/jasna.png" alt="Foto van Jasna Weber">

    
  `;
} else if (searchName === "") {
  searchResults.innerHTML = `<p class="error">Vul een naam in om te zoeken.</p>`;
} else {
  searchResults.innerHTML = `<p class="error">Geen gegevens gevonden voor: ${searchName}</p>`;
}
}


