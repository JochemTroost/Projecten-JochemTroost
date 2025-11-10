<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>opdracht-12</title>
  <link rel="stylesheet" href="styletama.css" />
</head>

<body>

  <section class="tamagotchi-container">
    <h1>Tamagotchi</h1>
    <p id="status">Maak 120 interactie's om te winnen.</p>
    <section class="status">
      <p>Honger: <strong id="outputHunger"></strong></p>
      <div class="status-bar">
        <div id="hungerBar" class="hunger-bar" style="width: 100%"></div>
      </div>
      <p>Energie: <strong id="outputEnergy"></strong></p>
      <div class="status-bar">
        <div id="energyBar" class="energy-bar" style="width: 100%"></div>
      </div>
      <p>Geluk: <strong id="outputHappiness"></strong></p>
      <div class="status-bar">
        <div
          id="happinessBar"
          class="happiness-bar"
          style="width: 100%"></div>
      </div>
      <p id="statusMessage"></p>
    </section>
    <div class="button-container">
      <button id="feed">Voeden</button>
      <button id="sleep">Slapen</button>
      <button id="play">Spelen</button>
    </div>
  </section>
  <script src="app3.js"></script>
</body>

</html>