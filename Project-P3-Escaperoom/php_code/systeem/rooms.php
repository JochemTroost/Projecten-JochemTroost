<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruimtes van de Escaperoom</title>
    <link href="../../Styling/style_admin.css" rel="stylesheet">
</head>
<body class="body-rooms">

<div class="container-rooms">
    <h2>Selecteer uit de lijst</h2>
    <div class="room-list">
        <button onclick="goToRoom('../aanmelden_team')">Aanmeld formulier</button>
        <button onclick="goToRoom('../room1')">Ruimte 1</button>
        <button onclick="goToRoom('../room2')">Ruimte 2</button>
        <button onclick="goToRoom('../room3')">Ruimte 3</button>
        <button onclick="goToRoom('../systeem/crudteamssysteem/manage_teams')">CRUD TEAMS</button>
        <button onclick="goToRoom('../systeem/crudquestions/manage_questions')">CRUD VRAGEN</button>
    </div>


</div>

<script>
    function goToRoom(room) {
        alert("Je wordt uitgelogd...");
        localStorage.removeItem("loggedIn"); // Simuleer uitloggen
        window.location.href = room + ".php"; // Stuur naar de juiste kamer
    }

    function goBack() {
        window.location.href = "menu.html"; // Terug naar het menu
    }
</script>
<div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</body>
</html>
