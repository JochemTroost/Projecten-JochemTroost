<?php
session_start();
require '../db.php';

$error = '';
$showResetLink = false; // standaard niet zichtbaar

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, password_hash, firstname, lastname FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $user['firstname'] . ' ' . $user['lastname'];
        header("Location: /dashboard/dashboard.php");
        exit;
    } else {
        $error = "Ongeldig e-mailadres of wachtwoord.";
        $showResetLink = true; // foutmelding = reset link tonen
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inloggen</title>
<link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    <div class="login-background">
        <div class="login-container">
            <div class="login-box">
                <a href="../index.php" class="back-button" title="Terug">&#10005;</a>
                <img class="logo-login" src="../style/JTS_Logo_png.png" alt="logo-png">
                <h2>Inloggen</h2>

                <?php if (!empty($error)) : ?>
                    <div class="status-error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" class="login-form" novalidate>
                    <input type="email" name="email" placeholder="E-mailadres" required autocomplete="username" />
                    <input type="password" name="password" placeholder="Wachtwoord" required autocomplete="current-password" />
                    <button type="submit">Inloggen</button>
                </form>

                <p class="register-text">
                    Nog geen account? <a href="register.php">Registreren</a>
                </p>

                <?php if ($showResetLink) : ?>
                    <p class="register-text">
                        <a href="forgetPassword.php">Wachtwoord vergeten?</a>
                    </p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
