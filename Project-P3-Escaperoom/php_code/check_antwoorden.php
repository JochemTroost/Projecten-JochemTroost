<?php
include "../php_code/db_connection/dbconn.php";
try {
    $db_connection = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"), true);
    $correct = [];
    $allCorrect = true;

    foreach ($data as $vraag_id => $antwoord) {
        $query = $db_connection->prepare("SELECT antwoord FROM vragen WHERE vraag_id = :vraag_id");
        $query->bindParam(':vraag_id', $vraag_id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && strtolower($result['antwoord']) === strtolower($antwoord)) {
            $correct[$vraag_id] = true;
        } else {
            $correct[$vraag_id] = false;
            $allCorrect = false;
        }
    }

    if ($allCorrect) {

        session_start();

        $teamName = isset($_SESSION['teamName']) ? htmlspecialchars($_SESSION['teamName']) : 'Onbekend';

        // Bereken de verstreken tijd
        if (isset($_SESSION['start_time'])) {
            $elapsed_time = time() - $_SESSION['start_time'];
            $minutes = floor($elapsed_time / 60);
            $seconds = $elapsed_time % 60;
            $formatted_time = sprintf("%02d:%02d", $minutes, $seconds);

            
        } else {
            $formatted_time = "00:00";
        }

        // Optioneel: Reset de tijd zodat een nieuw spel opnieuw begint
        setcookie("elapsed_time", $formatted_time, time() + 3600, "/"); // Cookie blijft 1 uur bewaard
        unset($_SESSION['start_time']);
        





        echo json_encode(["redirect" => "end.php"]);
    } else {
        echo json_encode(["correct" => $correct]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Verbinding mislukt: " . $e->getMessage()]);
}
