<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "p3-project-escaperoom";

try {
    $db_connection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "verbinding mislukt" . $e->getMessage();
}
?>