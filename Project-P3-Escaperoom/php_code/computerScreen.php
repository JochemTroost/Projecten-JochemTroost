<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Styling/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">


    <title>Escape room</title>
</head>
<body class="bodyComputerScreen">

    <div class="containerComputer login-container active">
    <div class="closeComputerScreen" ><a href="../php_code/room1.php">X</a></div>
        <h2>Inloggen Medisch Systeem</h2>
        <label class="computerLabel" for="medewerkersnummer">Medewerkersnummer:</label>
        <input class="computerInput" type="password" id="medewerkersnummer" placeholder="Voer uw nummer in">
        <button class="computerButton" onclick="login()">Inloggen</button>
        <div id="loginMessage" class="message"></div>
    </div>

    
    <div class="containerComputer menu-container">
    <div class="closeComputerScreen" ><a href="../php_code/room1.php">X</a></div>
        <h2>Zoeken op Naam</h2>
        <label class="computerLabel" for="searchName">Naam:</label>
        <input class="computerInput" type="text" id="searchName" placeholder="Voer een naam in">
        <button class="computerButton" onclick="search()">Zoeken</button>
        <div id="searchResults" class="results"></div>
    </div>

    <script src="../javascript_code/room1.js"> </script>

</body>
</html>
