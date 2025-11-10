function startGame(){

  location.href = "../Game Jochem/JS-game-jochem-reactiontime.php"
}
function skils() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let skils =
    "Mijn skils zijn: <br> HTML/CSS <br> Javascript <br> PHP/SQL <br> Arduino <br> Rasberry pie ";
  let portoimg = document.getElementById("portoimg");

  portoimg.src = "../CSS Code/img/R.jpg";
  p.innerHTML = skils;
  h2.innerText = "Mijn Skils";
}
function overMij() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let overmij =
    "Ik ben Jochem, een student van het <strong>TCR</strong> in schiedam. Ik volg de Opleiding software developer en ben altijd bezig met de huidige media. mijn hobby's zijn programmeren en het automatiseren van microcomputers zoals de arduino's en rasberry pie's. ";
  let portoimg = document.getElementById("portoimg");

  portoimg.src = "../CSS Code/img/Schiedamseweg245.jpg";
  p.innerHTML = overmij;
  h2.innerText = "Over Mij";
}
function contact() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let portoimg = document.getElementById("portoimg");
  let contactt =
    "Contact <br> Telefoon: <strong> 06 123345678 </strong><br> Mail:<strong> 9025293@student.zadkine.nl </strong><br> Adres: <strong>Schiedamseweg 254 </strong> ";
  portoimg.src =
    "../CSS Code/img/contactus-810f9fbd50c984380afdd8faa4ca6b0e1937d2a7d36471de66fc0f86beb4db9e.png";
  p.innerHTML = contactt;
  h2.innerText = "Contact";
}

function school() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let portoimg = document.getElementById("portoimg");
  let School =
    "Ik zit op het TCR schiedam. Ik volg daar de opleiding software development. Omdat programmeren al mijn hobby was past dit goed bij mij. ";
  portoimg.src = "../CSS Code/img/Schiedamseweg245.jpg";
  p.innerHTML = School;
  h2.innerText = "School";
}

function werk() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let portoimg = document.getElementById("portoimg");
  let werK =
    "Ik heb al een paar jaar werkervaring bij verschillende bedrijven. Ik werk nu bij <br> LIDL 530 maar vroeger heb ik ook bij de Jumbo en Hema gewerkt. Ik heb werken altijd erg leuk gevonden.";
  portoimg.src = "../CSS Code/img/Lidl-case-study.webp";
  p.innerHTML = werK;
  h2.innerText = "Werk";
}

function profielFoto() {
  let h2 = document.getElementById("displayZone-h2");
  let p = document.getElementById("displayZone-p");
  let portoimg = document.getElementById("portoimg");
  let profiel = ""
  portoimg.src = "../CSS Code/img/Afbeelding van WhatsApp op 2024-12-13 om 11.13.06_09f597d8.jpg";
  p.innerHTML = profiel;
  h2.innerText = "Profielfoto";
}

function confirm (){
  document.getElementById("confirm").innerHTML = "Bedankt voor uw bericht!";
}


