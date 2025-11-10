<?php
session_start();
require "../dbconn.php";

// Controleer of de gebruiker admin is
if (!isset($_SESSION["state"]) || $_SESSION["state"] == 0) {
    header("Location: ../no_access.php");
    exit();
}

// Controleer of er een ID is meegegeven via POST
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php?error=noid");
    exit();
}

$id = intval($_POST['id']); // Zet ID om naar een integer voor veiligheid
$name =  $_SESSION['first_name'] ." " . $_SESSION['infix'] . " " . $_SESSION['last_name'];
try {
    // Controleer of de gebruiker bestaat
    $query = "SELECT * FROM registrations WHERE id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php?error=notfound");
        exit();
    }

    // Gebruikersgegevens opslaan in de geschiedenis voordat ze worden verwijderd
    $historyquery = "INSERT INTO user_history (first_name, infix, last_name, age, email, phone_number, state,  worker_id, worker_name) 
                     VALUES (:first_name, :infix, :last_name, :age, :email, :phone_number, :state, :worker_id, :worker_name)";

    $historyquery_run = $db_connection->prepare($historyquery);
    $historyquery_success = $historyquery_run->execute([
        ":first_name"   => $user['first_name'],
        ":infix"        => $user['infix'],
        ":last_name"    => $user['last_name'],
        ":age"          => $user['age'],
        ":email"        => $user['email'],
        ":phone_number" => $user['phone_number'],
        ":state" => $user['state'],
        ":worker_id" => $_SESSION['id'],
        ":worker_name" => $name
    ]);

    if (!$historyquery_success) {
        header("Location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php?error=history_insert_failed");
        exit();
    }

    // Verwijder de gebruiker pas nadat de gegevens zijn opgeslagen
    $deleteQuery = "DELETE FROM registrations WHERE id = :id";
    $deleteStmt = $db_connection->prepare($deleteQuery);
    $deleteStmt->bindParam(":id", $id, PDO::PARAM_INT);
    $deleteStmt->execute();

    header("Location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php?success=deleted");
    exit();
} catch (PDOException $e) {
    error_log("Databasefout: " . $e->getMessage());
    header("Location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php?error=database");
    exit();
}
