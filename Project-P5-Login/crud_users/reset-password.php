<?php
session_start();
require '../db.php'; // $pdo met ERRMODE_EXCEPTION, FETCH_ASSOC

$error = '';
$success = '';

// Check of token en email in URL aanwezig zijn
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';

// Verwerking formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $new_password_confirm = $_POST['new_password_confirm'] ?? '';

    if (!$new_password || !$new_password_confirm) {
        $error = "Vul beide wachtwoordvelden in.";
    } elseif ($new_password !== $new_password_confirm) {
        $error = "Wachtwoord en bevestiging komen niet overeen.";
    } elseif (strlen($new_password) < 6) {
        $error = "Het wachtwoord moet minimaal 6 tekens bevatten.";
    } else {
        // Controleer token
        $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE email = ? AND token = ?");
        $stmt->execute([$email, $token]);
        $reset = $stmt->fetch();

        if ($reset && new DateTime() < new DateTime($reset['expires_at'])) {
            // Sla nieuw wachtwoord op
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
            $stmt->execute([$hash, $email]);

            // Verwijder token
            $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = ?");
            $stmt->execute([$email]);

            $success = "Je wachtwoord is succesvol gewijzigd. Je kunt nu inloggen.";
        } else {
            $error = "De resetlink is ongeldig of verlopen.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wachtwoord resetten</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    <?php include "../nav.php"; ?>

    <div class="main-content">
        <h1>Wachtwoord resetten</h1>

        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
            <a href="login.php" class="editPassword">Inloggen</a>
        <?php else: ?>
            <form method="post" action="reset-password.php" class="form-edit">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <label for="new_password">Nieuw wachtwoord *</label>
                <input type="password" id="new_password" name="new_password" required>

                <label for="new_password_confirm">Bevestig nieuw wachtwoord *</label>
                <input type="password" id="new_password_confirm" name="new_password_confirm" required>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Wijzigen</button>
                    <a href="login.php" class="btn-secondary">Annuleren</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
