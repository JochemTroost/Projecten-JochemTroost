<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../CSS Code/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>end</title>
</head>

<body>
  <header>
    <h1>End Game's</h1>
    <?php
    include "../PHP code/nav.php";
    ?>

  </header>


  <section class="gameZone">

    
    <p><strong>Goed gedaan!! Je hebt gewonnen</strong> <br><br>

    <p><strong>Gespeelde spellen</strong>
    <ul class="ull">
      <li> <strong>Reactie test</strong></li>
      <li>Klik binnen een tijd van 300ms om te winnen. </li><br>
      <li> <strong>Dino run</strong></li>
      <li>Haal een score van 350 punten om te winnen.</li><br>
      <li> <strong>Steen papier schaar</strong></li>
      <li>Versla de computer 3 keer en win!</li> <br>
      <li> <strong>Tamagotchi</strong></li>
      <li>Maak 120 interactie's met je tamagotchi en win!</li> <br>
    </ul>
    </p>
    <button class="buttonZone-button1" onclick="startGame()">Speel opnieuw</button>
  </section>
  <script src="../Javascript code/app.js"></script>
</body>

</html>