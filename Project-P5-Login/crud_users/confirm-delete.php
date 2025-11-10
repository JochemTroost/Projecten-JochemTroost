<?php
require '../db.php';

$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';
$message = '';

if ($email && $token) {
    $stmt = $pdo->prepare("SELECT * FROM delete_requests WHERE email = ? AND token = ? AND expires_at > NOW()");
    $stmt->execute([$email, $token]);
    $request = $stmt->fetch();

    if ($request) {
        // Markeer account als "pending delete"
        $stmt = $pdo->prepare("UPDATE users SET delete_at = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE id = ?");
        $stmt->execute([$request['user_id']]);

        $message = "Je account wordt over 30 dagen verwijderd. Als je je account tocht wilt houden kan je opnieuw inloggen, dan wordt dit verzoek automatisch geannuleerd.";
    } else {
        $message = "Ongeldige of verlopen link.";
    }
} else {
    $message = "Ongeldige aanvraag.";
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verwijdering bevestigen</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    
    <?php include "../nav.php" ?>
    <div class="main-content">
    <h1>Account Verwijderd</h1>
    <div class="center">
    <p><?= htmlspecialchars($message) ?></p>
    </div>
    </div>
</body>
</html>
