<?php
include "../../db_connection/dbconn.php";

if (isset($_GET['Team_id'])) {
    $teamId = $_GET['Team_id'];

    try {
        
        $query = "DELETE FROM teams WHERE Team_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([':id' => $teamId]);

        header("Location: manage_teams.php");
        exit(0);
    } catch (PDOException $e) {
        error_log("Database Delete Error: " . $e->getMessage());
        header("Location: manage_teams.php?error=delete_failed");
        exit(1);
    }
}
?>