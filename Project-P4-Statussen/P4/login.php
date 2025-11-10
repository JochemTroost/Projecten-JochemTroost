<?php
session_start();
$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";
unset($_SESSION["statusMsg"], $_SESSION["statusClass"]);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
</head>

<body>
<?php include "nav.php" ?> <br>
    <div class="container">
        <h1>Inloggen</h1><br>

        <?php if ($statusMsg): ?>
            <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
                <?= $statusMsg; ?>
            </div>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" > <br>
            
            <p>Nog geen account <a href="../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php">registreer</a> dan hier</p>

            <input type="submit" class="submitForm" name="login" value="Inloggen">
        </form>
    </div>



</body>
</html>
