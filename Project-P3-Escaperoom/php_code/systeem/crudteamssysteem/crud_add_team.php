<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../Styling/style_admin.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">


    <title>Escape room</title>
</head>

<body>

    <div class="aanmeldingsformulierDiv">

        <h1>Aanmelden Team</h1>
        <form action="" method="POST">
            <label for="teamName">Teamnaam</label> <br>
            <input type="text" class="inputForm" id="teamName" name="teamName" required minlength="5"> <br><br>
            <label for="namePlayer1">Speler 1</label> <br>
            <input type="text" class="inputForm" id="namePlayer1" name="namePlayer1" required> <br><br>
            <label for="namePlayer2">Speler 2</label> <br>
            <input type="text" class="inputForm" id="namePlayer2" name="namePlayer2"> <br><br>
            <label for="namePlayer3">Speler 3</label> <br>
            <input type="text" class="inputForm" id="namePlayer3" name="namePlayer3"> <br><br>
            <label for="score">Score </label> <br>
            <input type="number" class="inputForm" id="score" name="score" value="0">
            <input type="submit" class="submitForm" name="add_team" value="Aanmelden">
        </form>
    </div>

    <?php
    include "../../db_connection/dbconn.php";

    if (isset($_POST["add_team"])) {
        $teamName = $_POST["teamName"];
        $namePlayer1 = $_POST["namePlayer1"];
        $namePlayer2 = $_POST["namePlayer2"];
        $namePlayer3 = $_POST["namePlayer3"];
        $score = $_POST["score"];

        session_start();
        $_SESSION['teamName'] = $teamName;
        $_SESSION['namePlayer1'] = $namePlayer1;
        $_SESSION['namePlayer2'] = $namePlayer2;
        $_SESSION['namePlayer3'] = $namePlayer3;

        // Timer starten (20 minuten in seconden)
        $timerStartTime = time(); // Huidige tijd in seconden
        $_SESSION['timerStartTime'] = $timerStartTime;

        try {
            $query = "INSERT INTO teams (teamName, namePlayer1, namePlayer2, namePlayer3, score) VALUES (:teamName, :namePlayer1, :namePlayer2, :namePlayer3, :score)";
            $query_run = $db_connection->prepare($query);

            $teams = [
                ":teamName" => $teamName,
                ":namePlayer1" => $namePlayer1,
                ":namePlayer2" => $namePlayer2,
                ":namePlayer3" => $namePlayer3,
                ":score" => $score
            ];

            $query_execute = $query_run->execute($teams);

            if ($query_execute) {
                header("Location: manage_teams.php");
                exit(0);
            } else {
                header("Location: ../../crud_add_team.php.php?error=insert_failed");
                exit(1);
            }
        } catch (PDOException $e) {
            error_log("Database Insert Error: " . $e->getMessage());
            echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
        }
    }
    ?>


</body>
<div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</html>