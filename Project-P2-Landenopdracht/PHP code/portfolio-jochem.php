<!-- start datum 2-12-2024-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../CSS Code/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <header>
    <h1>Portofolio Jochem</h1>
    <?php include "nav.php" ?>
  </header>
  <section class="displayZone" id="displayZone">
    <div>
      <h2 id="displayZone-h2">Over Mij</h2>
      <p id="displayZone-p" class="displayZone-p">Ik ben Jochem, een student van het <strong>TCR</strong> in schiedam.
        Ik volg de Opleiding software developer en ben altijd bezig met de huidige media.
        mijn hobby's zijn programmeren en het automatiseren van microcomputers zoals de arduino's en rasberry pie's.
      </p>
      <img class="portoimg" id="portoimg" src="../CSS Code/./img/Schiedamseweg245.jpg" alt="TCR school">
    </div>
  </section>
  <section class="buttonZone" id="buttonZone">
    <button class="buttonZone-button" onclick="profielFoto()">Profielfoto</button>
    <button class="buttonZone-button" onclick="overMij()">Over Mij</button>
    <button class="buttonZone-button" onclick="skils()">Skils</button>
    <button class="buttonZone-button" onclick="werk()">Werk</button>
    <button class="buttonZone-button" onclick="school()">School</button>
    <button class="buttonZone-button" onclick="contact()">Contact</button>
    <script  src="../Javascript code/app.js"></script>
</body>

</html>