<?php
session_start();
require '../db.php'; // $pdo met ERRMODE_EXCEPTION, FETCH_ASSOC

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
            $expires_at = (new DateTime())->modify('+1 hour')->format('Y-m-d H:i:s');

            $stmt = $pdo->prepare("
                REPLACE INTO password_resets (email, token, expires_at)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$email, $token, $expires_at]);

            // Maak resetlink
            $resetLink = "http://localhost/dashboard/crud_users/reset-password.php?email=" . urlencode($email) . "&token=" . $token;

            // Sla e-mail op in bestand
            $emailContent = "Van: NoReply@JTS.com\n\n";
            $emailContent .= "Aan: $email\nOnderwerp: Wachtwoord reset aanvraag\n\n";
            $emailContent .= "Beste Jochem Troost,\n\n";
            $emailContent .= "Via onze website heeft een wachtwoordt wijziging aangevraagt.\n\n";
            $emailContent .= "Klik op deze link om je wachtwoord te wijzigen:\n$resetLink\n\n";
            $emailContent .= "Deze link is 1 uur geldig.\n\n";
            $emailContent .= "Mocht u niet van deze aanvraag op de hoogte zijn, dan kunt u deze mail negeren.\n\n";
            $emailContent .= "Met vriendelijke groet, Team JTS\n\n";
            file_put_contents($emailTestDir . '/test_email.txt', $emailContent, FILE_APPEND);

            $success = "Er is een test-e-mail gegenereerd. Controleer 'emails/test_email.txt' voor de resetlink.";
        } else {
            // E-mailadres niet geregistreerd
            $error = "Er is geen account gevonden met het opgegeven e-mailadres. <a class='editPassword' href='register.php'>Registreer hier een nieuw account</a>.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wachtwoord vergeten</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    <?php include "../nav.php"; ?>

    <div class="main-content">
        <h1>Wachtwoord vergeten</h1>

        <?php if ($error): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
        <?php else: ?>
            <form method="post" action="forgetPassword.php" class="form-edit">
                <label for="email">Vul je e-mailadres in *</label>
                <input type="email" id="email" name="email" required>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Verstuur resetlink</button>
                    <a href="settings.php" class="btn-secondary">Annuleren</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
