<?php
session_start(); // Sessies starten

$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";

// Verwijder de sessievariabelen na het tonen van de melding
unset($_SESSION["statusMsg"]);
unset($_SESSION["statusClass"]);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruiker aanmaken</title>
    <link rel="stylesheet" href="../style.css">

    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
</head>

<body>
<?php include "../nav.php" ?> <br>
    <div class="container">
        <h1>Gebruiker aanmaken</h1>

        <?php if ($statusMsg): ?>
            <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
                <?= $statusMsg; ?>
            </div>
        <?php endif; ?>
        <br>
        <form action="02_s_create_user.php" method="POST">
            
            <label for="first_name">Voornaam</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="infix">Tussenvoegsel</label>
            <input type="text" id="infix" name="infix">

            <label for="last_name">Achternaam</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="age">Leeftijd</label>
            <input type="number" id="age" name="age" required>
    
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="phone_number">Telefoonnummer</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="state">Status</label>
            <select name="state" id="state" class="inputForm" required>
                <option value="0">Klant</option>
                <option value="1">Werknemer</option>
                <option value="2">Admin</option>
            </select><br>

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required><br> <br>
            
            

            <input type="submit" class="submitForm" name="register" value="Registreren">
        </form>
    </div>

    <script>
        setTimeout(() => {
            const statusMessage = document.getElementById("statusMessage");
            if (statusMessage) {
                statusMessage.style.display = "none";
            }
        }, 3000);
    </script>

</body>

</html>
