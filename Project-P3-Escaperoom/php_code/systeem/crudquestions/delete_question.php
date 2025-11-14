<?php
include "../../db_connection/dbconn.php";

if (isset($_GET['vraag_id'])) {
    $vraagId = $_GET['vraag_id'];

    try {
        // Verwijderen van de vraag op basis van de vraag_id
        $query = "DELETE FROM vragen WHERE vraag_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([':id' => $vraagId]);

        header("Location: manage_questions.php"); // Redirect naar pagina voor vraagbeheer
        exit(0);
    } catch (PDOException $e) {
        error_log("Database Delete Error: " . $e->getMessage());
        header("Location: manage_questions.php?error=delete_failed");
        exit(1);
    }
}
?>
