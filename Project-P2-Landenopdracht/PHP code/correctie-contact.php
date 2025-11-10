<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../CSS Code/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Correctie</title>

</head>

<body>
  <header>
    <h1>Contact</h1>
    <?php
    include "nav.php";
    ?>

  </header>
  <section class="displayZone" id="displayZone">

    <div class="container">
      <h2>Contact</h2>
      <p>
        Heeft u opmerkingen over fouten op de website? Dit kunt u altijd mailen naar
        <a href="mailto:9025293@student.zadkine.nl">9025293@student.tcrmbo.nl</a>
        of vul het contactformulier hieronder in.
      </p>

      <h3>Contactformulier</h3>
      <form id="contact-form">
        <label for="name">Volledige naam:</label>
        <input type="text" id="name" name="name"  />
        <br>

        <label for="phone">Telefoon nummer:</label>
        <input type="number" id="phone" name="phone" required />
        <br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required />
        <br>

        <label for="problem">Uw klacht:</label>
        <select name="problem" id="problem">
          <option value="menu werkt niet">menu werkt niet</option>
          <option value="tekst is niet goed">tekst is niet goed</option>
          
          <option value="foto is niet zichtbaar">foto is niet zichtbaar</option>
          <option value="bezwaar tegen tekst">bezwaar tegen tekst</option>
          <option value="anders">anders</option>
        </select>
        <br>

        <label for="url">URL van foute pagina:</label>
        <input type="URL" id="url" name="url" required />
        <br>

        <label for="extra">Extra specificatie van fout:</label>
        <textarea id="extra" name="extra" rows="5" required></textarea>
        <br>

        <label for="date">Datum van waarnemen</label>
        <input type="date" id="date" name="date" required />
        <br>

        <button onclick="location.href = 'index.php';" id="myButton">annuleren</button>
        <button type="submit" id="submit" onclick="confirm()">Verstuur</button>
        <p id="confirm"></p>
      </form>
    </div>

    <script src="../Javascript code/app.js"></script>
</body>

</html>