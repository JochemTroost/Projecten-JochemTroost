<?php
session_start();
$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";
unset($_SESSION["statusMsg"], $_SESSION["statusClass"]);



require "dbconn.php";

// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['id'])) {


    try {
        // Haal gebruikersgegevens op
        $query = "SELECT * FROM registrations WHERE id = :id";
        $stmt = $db_connection->prepare($query);
        $stmt->execute([':id' => $_SESSION['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['state'] == 2) {
            $state = "Admin";
        } elseif ($user['state'] == 1) {
            $state = "Werknemer";
        } else {
            $state = "Klant";
        }


        if (!$user) {
            header("location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        echo ("Database Fetch Error: " . $e->getMessage());
        header("location: register.php");
        exit();
    }
} else {
    $_SESSION['statusMsg'] = "❌ U moet ingelogd zijn om uw account te kunnen zien.";
    $_SESSION['statusClass'] = "error";
    header("location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Account</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "nav.php"; ?> <br><br><br>
    <?php if ($statusMsg): ?>
        <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
            <?= $statusMsg; ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <h1>Mijn gegevens</h1>
        <p>Je kan je eigen gegevens niet wijzigen. <br> Als je gegevens toch gewijzigd moeten worden neem dan <a href="mailto:example@example.com">contact</a> op met de helpdesk</p>
    <table>

        <tr>
            <th>Veld</th>
            <th>Gegevens</th>
        </tr>
        <tr>
            <td><strong>Voornaam</strong></td>
            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
        </tr>
        <tr>
            <td><strong>Tussenvoegsel</strong></td>
            <td><?php echo htmlspecialchars($user['infix']); ?></td>
        </tr>
        <tr>
            <td><strong>Achternaam</strong></td>
            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
        </tr>
        <tr>
            <td><strong>Leeftijd</strong></td>
            <td><?php echo htmlspecialchars($user['age']); ?></td>
        </tr>
        <tr>
            <td><strong>E-mail</strong></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <tr>
            <td><strong>Telefoonnummer</strong></td>
            <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
        </tr>
        <tr>
            <td><strong>status</strong></td>
            <td><?php echo $state; ?></td>
        </tr>
        <tr>
            <td><strong>Wachtwoord</strong></td>
            <td><a class="psww" href="password.php">Wachtwoord wijzigen</a></td>
        </tr>
    </table>
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