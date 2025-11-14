<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "p3-project-escaperoom";

try {
    $db_connection = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $db_connection->prepare("SELECT vraag_id, vraag FROM vragen");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(["error" => "Verbinding mislukt: " . $e->getMessage()]);
}
?>
