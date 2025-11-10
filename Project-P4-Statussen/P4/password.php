<?php
session_start();
$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";
unset($_SESSION["statusMsg"], $_SESSION["statusClass"]);
if (!isset($_SESSION['id'])) {
    $_SESSION['statusMsg'] = "❌ U moet ingelogd zijn om uw wachtwoord te wijzigen.";
    $_SESSION['statusClass'] = "error";
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord wijzigen</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
</head>

<body>
<?php include "nav.php" ?> <br>
    <div class="container">
        <h1>Wachtwoord wijzigen</h1><br>

        <?php if ($statusMsg): ?>
            <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
                <?= $statusMsg; ?>
            </div>
        <?php endif; ?>

        <form action="password_edit.php" method="POST">
            <label for="oldpassword">Oud Wachtwoord</label>
            <input type="password" id="oldpassword" name="oldpassword" > <br><br>

            <label for="firstpassword">Nieuw Wachtwoord</label>
            <input type="password" id="firstpassword" name="firstpassword" > <br>
            
            <label for="secondpassword">Herhaal Wachtwoord</label>
            <input type="password" id="secondpassword" name="secondpassword" > <br> <br>
            
            
            <input type="submit" class="submitForm" name="edit" value="wijzigen">
        </form>
    </div>

    <script>

        setTimeout(() => {
            const statusMessage = document.getElementById("statusMessage");
            if (statusMessage) {
                statusMessage.style.opacity = 0; 
            }
        }, 3000);
    </script>

</body>
</html>
