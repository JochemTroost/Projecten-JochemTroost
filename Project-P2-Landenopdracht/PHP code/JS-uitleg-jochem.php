<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../CSS Code/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Uitleg Jochem</title>
</head>

<body>
  <header>
    <h1>Game uitleg Jochem</h1>
    <?php
    include "nav.php";
    ?>

  </header>


  <section class="gameZone">

    <p>Het is de bedoeling dat je de spelreeks gaat uitspelen.
      dit doe je door score's te halen in mini game's. als je score hoog genoeg is mag je daar naar de volgende mini game.
      als je alle mini game's heb uitgespeeld heb je gewonnen.
    </p>
    <p><strong>De mini game's die je gaat spelen zijn:</strong>
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
    <button class="buttonZone-button1" onclick="startGame()">Start het spel</button>
  </section>
  <script src="../Javascript code/app.js"></script>
</body>

</html>