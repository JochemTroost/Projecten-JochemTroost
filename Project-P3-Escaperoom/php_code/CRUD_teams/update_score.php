<?php
include "../php_code/db_connection/dbconn.php";

try {
    // Selecteer alle scores
    $query = "SELECT id, score FROM teams";
    $get_score = $db_connection->prepare($query);
    $get_score->execute();

    $scores = $get_score->fetchAll(PDO::FETCH_ASSOC);

    if ($scores) {
        foreach ($scores as $team) {
            $oldScore = $team["score"];
            $newScore = $oldScore + 10;

            // Update de score voor het specifieke team
            $update_query = "UPDATE teams SET score = :score WHERE id = :id";
            $update_stmt = $db_connection->prepare($update_query);
            $update_success = $update_stmt->execute([
                ":score" => $newScore,
                ":id" => $team["id"]
            ]);

            if (!$update_success) {
                header("Location: add_team.php?error=update_failed");
                exit(1);
            }
        }
        // Als alles succesvol is, doorverwijzen
        header("Location: ../php_code/room1.php");
        exit(0);
    } else {
        header("Location: add_team.php?error=no_teams_found");
        exit(1);
    }
} catch (PDOException $e) {
    // Log fouten en toon een generieke foutmelding
    error_log("Database Error: " . $e->getMessage());
    echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
}
