<?php
session_start();
require '../db.php'; // $pdo moet bestaan, ERRMODE_EXCEPTION, FETCH_ASSOC

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$error = '';
$success = '';

// Gegevens ophalen om formulier te vullen
$stmt = $pdo->prepare("
    SELECT id, firstname, middlename, lastname, email, phone, birth 
    FROM users 
    WHERE LOWER(email) = LOWER(?)
    LIMIT 1
");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    echo "Gebruiker niet gevonden.";
    exit;
}

// Verwerken formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname'] ?? '');
    $middlename = trim($_POST['middlename'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $new_email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $birth = trim($_POST['birth'] ?? '');

    // Simpele validatie
    if (!$firstname || !$lastname || !$new_email || !$birth) {
        $error = "Voornaam, achternaam, e-mail en geboortedatum zijn verplicht.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)) {
        $error = "Geboortedatum moet een geldige datum zijn (YYYY-MM-DD).";
    } else {
        // Update query op basis van email
        $stmt = $pdo->prepare("
            UPDATE users 
            SET firstname = ?, middlename = ?, lastname = ?, email = ?, phone = ?, birth = ? 
            WHERE id = ?
        ");
        $updated = $stmt->execute([
            $firstname,
            $middlename,
            $lastname,
            $new_email,
            $phone,
            $birth,
            $user['id']
        ]);

        if ($updated) {
            // Update de sessie als het email-adres is gewijzigd
            $_SESSION['email'] = $new_email;
            header("Location: account.php");
            exit;
        } else {
            $error = "Er is iets misgegaan bij het opslaan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gegevens Wijzigen - Mijn Account</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body>

    <?php include "../nav.php" ?>

    <div class="main-content">
        <h1>Gegevens wijzigen</h1>

        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="settings.php" class="form-edit">
            <label for="firstname">Voornaam *</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required>

            <label for="middlename">Tussenvoegsel</label>
            <input type="text" id="middlename" name="middlename" value="<?= htmlspecialchars($user['middlename'] ?? '') ?>">


            <label for="lastname">Achternaam *</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required>

            <label for="birth">Geboortedatum *</label>
            <input type="date" id="birth" name="birth" value="<?= htmlspecialchars($user['birth']) ?>" required>

            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="phone">Telefoon</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
            <div class="divEditPassword">
                <a class="editPassword" href="editPassword.php"><strong>Wachtwoord wijzigen</strong></a>
                <a class="editPassword" href="deleteAccount.php"><strong>Account Verwijderen</strong></a>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="settings.php" class="btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>

</body>

</html>