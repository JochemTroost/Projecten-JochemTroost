<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require "db.php"; // ✅ Laad de databaseverbinding uit db.php

$user_id = $_SESSION['user_id'];

// Toevoegen van nieuwe link
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_link'])) {
    $naam = trim($_POST['naam']);
    $url = trim($_POST['url']);
    if ($naam && $url) {
        $stmt = $pdo->prepare("INSERT INTO snelkoppelingen (user_id, naam, url) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $naam, $url]);
    }
}

// Verwijderen van link
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM snelkoppelingen WHERE id = ? AND user_id = ?");
    $stmt->execute([$delete_id, $user_id]);
}

// Ophalen van links
$stmt = $pdo->prepare("SELECT id, naam, url FROM snelkoppelingen WHERE user_id = ?");
$stmt->execute([$user_id]);
$snelkoppelingen = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>JTS Dashboard</title>
    <link rel="stylesheet" href="../dashboard/style/style.css">
</head>
<body>

<?php include "nav.php"; ?>
<div class="dashboard-container">
    <!-- Linkerkant: snelkoppelingen -->
    <div class="card_snelkoppelingen">
        <h3>📎 Mijn snelkoppelingen</h3>
        
        <ul>
            <?php if (count($snelkoppelingen) > 0): ?>
                <?php foreach ($snelkoppelingen as $link): ?>
                    <li>
                        <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank">
                            <?= htmlspecialchars($link['naam']) ?>
                        </a>
                        <a href="?delete_id=<?= $link['id'] ?>" style="color:#f87171; margin-left:10px;">✕</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li><em>Geen snelkoppelingen toegevoegd.</em></li>
            <?php endif; ?>
        </ul>

        <form method="POST" style="margin-top:1rem;">
            <input type="text" name="naam" placeholder="Naam van link" required>
            <input type="url" name="url" placeholder="https://voorbeeld.nl" required>
            <button type="submit" name="add_link" class="btn">➕ Toevoegen</button>
        </form>
    </div>

    <!-- Rechterkant: overige dashboard-content -->
    <div class="dashboard-main">
        <h3>Welkom terug, <?= htmlspecialchars($_SESSION['name'] ?? 'Gebruiker') ?> 👋</h3>
        <p>Hier kun je later andere dashboardwidgets of statistieken plaatsen.</p>
    </div>
</div>


</body>
</html>
