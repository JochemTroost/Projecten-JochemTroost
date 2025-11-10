<?php
session_start();
require '../db.php';

$step = $_GET['step'] ?? 1;
$errors = [];

if (!isset($_SESSION['register'])) $_SESSION['register'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($step) {
        case 1:
            $firstname = trim($_POST['firstname'] ?? '');
            $middlename = trim($_POST['middlename'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');

            if (!$firstname) $errors[] = 'Voornaam is verplicht.';
            if (!$lastname) $errors[] = 'Achternaam is verplicht.';

            if (!$errors) {
                $_SESSION['register']['firstname'] = $firstname; // alleen voornaam opslaan
                $_SESSION['register']['middlename'] = $middlename;
                $_SESSION['register']['lastname'] = $lastname;
                header('Location: register.php?step=2'); 
                exit;
            }
            break;

        case 2:
            $birth = $_POST['birth'] ?? '';
            $d = DateTime::createFromFormat('Y-m-d', $birth);
            if (!$d || $d->format('Y-m-d') !== $birth) $errors[] = 'Ongeldige geboortedatum.';

            if (!$errors) {
                $_SESSION['register']['birth'] = $birth;
                header('Location: register.php?step=3'); 
                exit;
            }
            break;

        case 3:
            $email = trim($_POST['email'] ?? '');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Ongeldig e-mailadres.';

            $stmt = $pdo->prepare("SELECT id FROM users WHERE LOWER(email) = LOWER(?)");
            $stmt->execute([$email]);
            if ($stmt->fetch()) $errors[] = 'Dit e-mailadres is al geregistreerd.';

            if (!$errors) {
                $_SESSION['register']['email'] = $email;
                header('Location: register.php?step=4'); 
                exit;
            }
            break;

        case 4:
            $phone = preg_replace('/\D+/', '', $_POST['phone'] ?? '');
            if (!$phone || strlen($phone) < 6) {
                $errors[] = 'Ongeldig telefoonnummer.';
            } else {
                $stmt = $pdo->prepare("SELECT id FROM users WHERE phone = ?");
                $stmt->execute([$phone]);
                $existingPhone = $stmt->fetch();

                if ($existingPhone && !isset($_POST['continue_with_existing_phone'])) {
                    $_SESSION['register']['phone_pending'] = $phone;
                    header('Location: register.php?step=4&phone_exists=1'); 
                    exit;
                } else {
                    $_SESSION['register']['phone'] = $phone;
                    unset($_SESSION['register']['phone_pending']);
                    header('Location: register.php?step=5'); 
                    exit;
                }
            }
            break;

        case 5:
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';
            if (strlen($password) < 6) $errors[] = 'Wachtwoord minimaal 6 tekens.';
            if ($password !== $password_confirm) $errors[] = 'Wachtwoorden komen niet overeen.';

            if (!$errors) {
                $_SESSION['register']['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
                $data = $_SESSION['register'];

                $stmt = $pdo->prepare("INSERT INTO users 
                    (firstname,middlename,lastname,birth,email,phone,password_hash,state)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'active')");
                $stmt->execute([
                    $data['firstname'],
                    $data['middlename'] ?: null,
                    $data['lastname'],
                    $data['birth'],
                    $data['email'],
                    $data['phone'],
                    $data['password_hash']
                ]);

                $user_id = $pdo->lastInsertId();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $data['email'];
                $_SESSION['state'] = 'active';
                $_SESSION['name'] = $data['firstname'] . ($data['middlename'] ? ' ' . $data['middlename'] : '') . ' ' . $data['lastname'];

                unset($_SESSION['register']);
                header('Location: ../dashboard.php'); 
                exit;
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registreren</title>
<link rel="stylesheet" href="../style/style.css">
<style>
.form-step { display:none; }
.form-step.active { display:block; }
.question { font-size:1.2em; margin-bottom:0.5em; }
</style>
</head>
<body>
     <div class="login-background">
<div class="login-container">
    <div class="login-box">
        <a href="../index.php" class="back-button" title="Terug">&#10005;</a>
        <h2>Registreren</h2>

        <?php if ($errors): ?>
            <div class="error-message">
                <ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul>
            </div>
        <?php endif; ?>

        <form method="POST">
            <?php if ($step == 1): ?>
                <div class="form-step active">
                    <p class="question">Wat is je volledige naam?</p>
                    <input type="text" name="firstname" placeholder="Voornaam" required value="<?= htmlspecialchars($_SESSION['register']['firstname'] ?? '') ?>"><br>
                    <input type="text" name="middlename" placeholder="Tussenvoegsel (optioneel)" value="<?= htmlspecialchars($_SESSION['register']['middlename'] ?? '') ?>"><br>
                    <input type="text" name="lastname" placeholder="Achternaam" required value="<?= htmlspecialchars($_SESSION['register']['lastname'] ?? '') ?>"><br>
                    <button type="submit">Volgende</button>
                </div>
            <?php elseif ($step == 2): ?>
                <div class="form-step active">
                    <p class="question">Hallo <?= htmlspecialchars($_SESSION['register']['firstname']) ?>, wat is je geboortedatum?</p>
                    <input type="date" name="birth" required value="<?= htmlspecialchars($_SESSION['register']['birth'] ?? '') ?>"><br>
                    <button type="submit">Volgende</button>
                </div>
            <?php elseif ($step == 3): ?>
                <div class="form-step active">
                    <p class="question"><?= htmlspecialchars($_SESSION['register']['firstname']) ?>, wat is je e-mailadres?</p>
                    <input type="email" name="email" required value="<?= htmlspecialchars($_SESSION['register']['email'] ?? '') ?>"><br>
                    <button type="submit">Volgende</button>
                </div>
            <?php elseif ($step == 4): ?>
                <div class="form-step active">
                    <p class="question"><?= htmlspecialchars($_SESSION['register']['firstname']) ?>, wat is je telefoonnummer?</p>
                    <input type="tel" name="phone" required value="<?= htmlspecialchars($_SESSION['register']['phone_pending'] ?? $_SESSION['register']['phone'] ?? '') ?>"><br>
                    <?php if (isset($_GET['phone_exists'])): ?>
                        <p style="color:orange;">
                            Dit telefoonnummer is al bekend bij een andere gebruiker. Wil je doorgaan met dit nummer?
                        </p>
                        <input type="hidden" name="continue_with_existing_phone" value="1">
                    <?php endif; ?>
                    <button type="submit">Volgende</button>
                </div>
            <?php elseif ($step == 5): ?>
                <div class="form-step active">
                    <p class="question"><?= htmlspecialchars($_SESSION['register']['firstname']) ?>, kies een wachtwoord</p>
                    <input type="password" name="password" placeholder="Wachtwoord" required><br>
                    <input type="password" name="password_confirm" placeholder="Herhaal wachtwoord" required><br>
                    <button type="submit">Registreren</button>
                </div>
            <?php endif; ?>
        </form>

        <p class="register-text">
            Al een account? <a href="login.php">Inloggen</a>
        </p>
    </div>
</div>
</div>
</body>
</html>
