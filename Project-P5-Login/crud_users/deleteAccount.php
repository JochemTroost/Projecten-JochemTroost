<?php
session_start();
require '../db.php'; // bevat $pdo

$error = '';
$success = '';

// Map voor test-e-mails
$emailTestDir = __DIR__ . '/../emails';
if (!is_dir($emailTestDir)) {
    mkdir($emailTestDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (!$email) {
        $error = "Vul je e-mailadres in.";
    } else {
        // Controleer of het e-mailadres bestaat
        $stmt = $pdo->prepare("SELECT id FROM users WHERE LOWER(email) = LOWER(?)");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Genereer token
            $token = bin2hex(random_bytes(32));
            $expires_at = (new DateTime())->modify('+1 day')->format('Y-m-d H:i:s'); // 24 uur geldig

            $stmt = $pdo->prepare("
                REPLACE INTO delete_requests (user_id, email, token, expires_at, requested_at)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$user['id'], $email, $token, $expires_at]);

            // Maak deletelink
            $deleteLink = "http://localhost/dashboard/crud_users/confirm-delete.php?email=" . urlencode($email) . "&token=" . $token;

            // Sla e-mail op in bestand (voor test)
            $emailContent = "Van: NoReply@JTS.com\n\n";
            $emailContent .= "Aan: $email\nOnderwerp: Bevestig accountverwijdering\n\n";
            $emailContent .= "Beste gebruiker,\n\n";
            $emailContent .= "Je hebt verzocht om je account te verwijderen.\n";
            $emailContent .= "Klik op deze link om dit te bevestigen:\n$deleteLink\n\n";
            $emailContent .= "Na bevestiging wordt je account na 30 dagen definitief verwijderd.\n";
            $emailContent .= "Als je dit niet hebt aangevraagd, kun je deze e-mail negeren.\n\n";
            $emailContent .= "Met vriendelijke groet, Team JTS\n\n";
            file_put_contents($emailTestDir . '/delete_email.txt', $emailContent, FILE_APPEND);

            $success = "Er is een test-e-mail gegenereerd. Controleer 'emails/delete_email.txt' voor de deletelink.";
        } else {
            $error = "Geen account gevonden met dit e-mailadres.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Account verwijderen</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    <?php include "../nav.php"; ?>

    <div class="main-content">
        <h1>Account verwijderen</h1>

        <?php if ($error): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
        <?php else: ?>
            <form method="post" action="deleteAccount.php" class="form-edit">
                <label for="email">Vul je e-mailadres in *</label>
                <input type="email" id="email" name="email" required>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Verstuur verwijderlink</button>
                    <a href="settings.php" class="btn-secondary">Annuleren</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
