<?php
include "../../php_code/db_connection/dbconn.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="../../Styling/style.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score tabel</title>
</head>

<body class="bodyAanmeldenTeam">
<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>Teamnaam</th>
                <th>Speler 1</th>
                <th>Speler 2</th>
                <th>Speler 3</th>
                <th>Tijd</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                
                $query = "SELECT * FROM teams ORDER BY score DESC";
                $get_teams = $db_connection->prepare($query);
                $get_teams->execute();
                
                $teams = $get_teams->fetchAll();

                if ($teams) {
                    foreach ($teams as $team) {
            ?>
                        <tr>
                            <td><?= htmlspecialchars($team["teamName"]) ?></td>
                            <td><?= htmlspecialchars($team["namePlayer1"]) ?></td>
                            <td><?= htmlspecialchars($team["namePlayer2"]) ?></td>
                            <td><?= htmlspecialchars($team["namePlayer3"]) ?></td>
                            <td><?= htmlspecialchars($team["tijd"]) ?></td>
                            <td><?= htmlspecialchars($team["score"]) ?></td>
                        </tr>
            <?php
                    }
                }
            } catch (PDOException $e) {
                error_log("Database Query Error: " . $e->getMessage());
                echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
            }
            ?>
            
        </tbody>
    </table>

</div>
<div class="buttons">
    <a href="../end.php" class="button">Terug naar eindscherm</a>
</div>
<div class="footerEnd">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</body>

</html>
