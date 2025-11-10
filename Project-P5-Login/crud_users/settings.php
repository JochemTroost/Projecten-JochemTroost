<?php
session_start();
require '../db.php'; // $pdo moet bestaan, ERRMODE_EXCEPTION, FETCH_ASSOC

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

// Gegevens ophalen op basis van email
$stmt = $pdo->prepare("
    SELECT id, firstname, middlename, lastname, birth, email, phone, state 
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
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Mijn Account</title>
<link rel="stylesheet" href="../style/style.css" />
</head>
<body>

<?php include "../nav.php" ?>

<div class="main-content">
      <a href="../dashboard.php" class="back-button" title="Terug">&#10005;</a>
  <h1>Mijn Account</h1>

  <table class="account-table">
    <tr>
        <th data-label="Naam">Naam</th>
        <td><?= htmlspecialchars($user['firstname'] . 
            ($user['middlename'] ? ' ' . $user['middlename'] : '') . 
            ' ' . $user['lastname']) ?></td>
    </tr>
    <tr>
        <th data-label="Geboortedatum">Geboortedatum</th>
        <td><?= htmlspecialchars($user['birth']) ?></td>
    </tr>
    <tr>
        <th data-label="E-mail">E-mail</th>
        <td><?= htmlspecialchars($user['email']) ?></td>
    </tr>
    <tr>
        <th data-label="Telefoon">Telefoon</th>
        <td><?= htmlspecialchars($user['phone']) ?></td>
    </tr>

  
  </table>

  <form action="editSettings.php" method="get" class="form-inline">
    <button type="submit" class="btn-primary">Gegevens wijzigen</button>
  </form>
</div>

</body>
</html>
