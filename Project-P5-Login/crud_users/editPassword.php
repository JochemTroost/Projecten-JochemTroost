<?php
session_start();
require '../db.php'; // $pdo met ERRMODE_EXCEPTION, FETCH_ASSOC

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$error = '';
$success = '';

// Formulier verwerking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $new_password_confirm = $_POST['new_password_confirm'] ?? '';

    // Oude wachtwoord ophalen
    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE LOWER(email) = LOWER(?)");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "Gebruiker niet gevonden.";
    } elseif (empty($old_password) || empty($new_password) || empty($new_password_confirm)) {
        $error = "Vul alle velden in.";
    } elseif (!password_verify($old_password, $user['password_hash'])) {
        $error = "Oud wachtwoord is onjuist.";
    } elseif ($new_password !== $new_password_confirm) {
        $error = "Nieuw wachtwoord en bevestiging komen niet overeen.";
    } elseif (strlen($new_password) < 6) {
        $error = "Nieuw wachtwoord moet minimaal 6 tekens bevatten.";
    } else {
        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $updated = $stmt->execute([$new_hash, $user['id']]);

        if ($updated) {
            $success = "Wachtwoord succesvol gewijzigd.";
            header("Refresh:2; url=account.php");
        } else {
            $error = "Er is iets misgegaan bij het wijzigen.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wachtwoord Wijzigen</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body>

    <?php include "../nav.php"; ?>

    <div class="main-content">
        <h1>Wachtwoord wijzigen</h1>

        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
            <p>Je wordt binnen 2 seconden teruggestuurd naar de accountpagina.</p>
        <?php else: ?>
            <form method="post" action="settings.php" class="form-edit">
                <label for="old_password">Oud wachtwoord *</label>
                <input type="password" id="old_password" name="old_password" required>

                <label for="new_password">Nieuw wachtwoord *</label>
                <input type="password" id="new_password" name="new_password" required>

                <label for="new_password_confirm">Bevestig nieuw wachtwoord *</label>
                <input type="password" id="new_password_confirm" name="new_password_confirm" required>
                <a class="editPassword" href="forgetPassword.php"><strong>Wachtwoord Vergeten</strong></a>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Wijzigen</button>
                    <a href="settings.php" class="btn-secondary">Annuleren</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>