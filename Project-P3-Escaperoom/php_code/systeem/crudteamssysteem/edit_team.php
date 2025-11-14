<?php
include "../../db_connection/dbconn.php";

if (isset($_GET['Team_id'])) {
    $teamId = $_GET['Team_id'];

    try {
        // Ophalen van het team op basis van de ID
        $query = "SELECT * FROM teams WHERE Team_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([':id' => $teamId]);
        $team = $query_run->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Fetch Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
        exit();
    }

    if (!$team) {
        echo "<p>Team niet gevonden.</p>";
        exit();
    }
}

if (isset($_POST['update_team'])) {
    // Gegevens ophalen uit formulier
    $teamName = $_POST['teamName'];
    $namePlayer1 = $_POST['namePlayer1'];
    $namePlayer2 = $_POST['namePlayer2'];
    $namePlayer3 = $_POST['namePlayer3'];
    $score = $_POST['score'];
    $teamId = $_POST['Team_id'];

    try {
        $query = "UPDATE teams SET teamName = :teamName, namePlayer1 = :namePlayer1, namePlayer2 = :namePlayer2, namePlayer3 = :namePlayer3, score = :score WHERE Team_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([
            ':teamName' => $teamName,
            ':namePlayer1' => $namePlayer1,
            ':namePlayer2' => $namePlayer2,
            ':namePlayer3' => $namePlayer3,
            ':score' => $score,
            ':id' => $teamId
        ]);

        header("Location: manage_teams.php");
        exit(0);
    } catch (PDOException $e) {
        error_log("Database Update Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Bewerken</title>
    <link rel="stylesheet" href="../../../Styling/style_admin.css">
</head>
<body>

    <div class="container">
        <h1>Team Bewerken</h1>

        <form action="edit_team.php" method="POST">
            <input type="hidden" name="Team_id" value="<?php echo htmlspecialchars($team['Team_id']); ?>">
            
            <label for="teamName">Teamnaam</label><br>
            <input type="text" name="teamName" value="<?php echo htmlspecialchars($team['teamName']); ?>" required><br><br>

            <label for="namePlayer1">Speler 1</label><br>
            <input type="text" name="namePlayer1" value="<?php echo htmlspecialchars($team['namePlayer1']); ?>" required><br><br>

            <label for="namePlayer2">Speler 2</label><br>
            <input type="text" name="namePlayer2" value="<?php echo htmlspecialchars($team['namePlayer2']); ?>"><br><br>

            <label for="namePlayer3">Speler 3</label><br>
            <input type="text" name="namePlayer3" value="<?php echo htmlspecialchars($team['namePlayer3']); ?>"><br><br>

            <label for="score">Score</label><br>
            <input type="number" name="score" value="<?php echo htmlspecialchars($team['score']); ?>" required><br><br>

            <input type="submit" name="update_team" value="Bijwerken">
        </form>
    </div>
    <div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</body>
</html>
