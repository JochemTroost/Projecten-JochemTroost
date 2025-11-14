<?php session_start();
if (isset($_SESSION['teamName'])) {
    $teamName = htmlspecialchars($_SESSION['teamName']);
    $namePlayer1 = htmlspecialchars($_SESSION['namePlayer1']);
    $namePlayer2 = htmlspecialchars($_SESSION['namePlayer2']);
    $namePlayer3 = htmlspecialchars($_SESSION['namePlayer3']);
}

include "../php_code/db_connection/dbconn.php";

$teamName = isset($_SESSION['teamName']) ? htmlspecialchars($_SESSION['teamName']) : 'Onbekend';

// Controleer of de tijd in de cookie staat
if (isset($_COOKIE['elapsed_time'])) {
    $formatted_time = $_COOKIE['elapsed_time'];

    // Tijd omzetten naar seconden
    list($minutes, $seconds) = explode(":", $formatted_time);
    $total_seconds = ($minutes * 60) + $seconds;

    // Score berekenen
    if ($total_seconds >= 1500) { // Meer dan 25:00 minuten
        $score = "Verloren";
    } else {
        $score = round(1000 - (($total_seconds * 1000) / 1500)); 
    }

    $show_score = true;

    try {
        // Databaseverbinding maken
        $db_connection = new PDO("mysql:host=$server;dbname=$db", $username, $password);
        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Score en tijd opslaan in database
        $query = "UPDATE teams SET score = :score, tijd = :tijd WHERE teamName = :teamName";
        $query_run = $db_connection->prepare($query);

        $data = [
            ":score" => is_numeric($score) ? $score : NULL, // NULL als "Verloren"
            ":tijd" => $formatted_time,
            ":teamName" => $teamName
        ];

        $query_execute = $query_run->execute($data);

        if (!$query_execute) {
            error_log("Fout bij opslaan van score en tijd.");
        }
    } catch (PDOException $e) {
        error_log("Databasefout: " . $e->getMessage());
    }
} else {
    $formatted_time = "00:00";
    $show_score = false; // Geen score tonen als de tijd niet beschikbaar is
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Styling/style.css" rel="stylesheet">
    <title>Game Eindpagina</title>
</head>

<body class="bodyRoom1">
    <div class="endPageContainer">
        
        <h1>Goed gedaan</h1>

        <div class="gameDetails">
            <?php if ($show_score): ?>
                <p><strong>Score:</strong> <?= $score ?></p>
            <?php endif; ?>

            <p><strong>Tijd:</strong> <?= $formatted_time ?></p>
            <p><strong>Teamnaam:</strong> <?= $teamName ?></p>
            <p><strong>Teamspelers:</strong> <?= $namePlayer1 ?>, <?= $namePlayer2 ?>, <?= $namePlayer3 ?></p>
        </div>

        <div class="buttons">
        
    <a href="../../Project-p3-Escaperoom/php_code/CRUD_teams/score_table.php" class="button">Bekijk Scoretabel</a>
    <a href="../php_code/aanmelden_team.php" class="button restart-button">Opnieuw spelen?</a>
    <a href="../../Project-p3-Escaperoom/php_code/index.php" class="button close-button">Afsluiten</a> <br><br>
   
    <a href="../../Project-p3-Escaperoom/php_code/systeem/master.php" class="button admin-button">Admin</a>
</div>


        <!-- Credits sectie -->
        <div class="creditsSection">
            <h2>Credits</h2>
            <p>Ontwikkeld door: Jochem Troost</p>
            <p>Design door: Jochem Troost</p>
            <p>Geluiden: Jochem Troost</p>
            <p>Speciale Bedankjes aan: Microsoft designer</p>
        </div>
    </div>
    <div class="footerEnd">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>

</body>

</html>