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
        <input type="hidden" class="inputForm" id="score" name="score" value="0">
        <input type="submit" class="submitForm" name="add_team" value="Aanmelden">
    </form>
</div>

<?php
include "../php_code/db_connection/dbconn.php";

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
            header("Location: ../php_code/room1.php");
            exit(0);
        } else {
            header("Location: add_team.php?error=insert_failed");
            exit(1);
        }
    } catch (PDOException $e) {

        error_log("Database Insert Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
      
    }
}

?>