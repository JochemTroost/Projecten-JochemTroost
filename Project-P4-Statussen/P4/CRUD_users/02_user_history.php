<?php
session_start();
require "../dbconn.php";

if ($_SESSION["state"] != 2) {
    header('location: ../no_access.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersgeschiedenis</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../nav.php"; ?>

    <div class="container">
        <h1>Gebruikersgeschiedenis</h1>

        <table border="1">
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Telefoonnummer</th>
                <th>Leeftijd</th>
                <th>Status</th>
                <th>Verwijderd door</th>
            </tr>
            <?php
            try {
                $query = "SELECT * FROM user_history ORDER BY first_name ASC";
                $stmt = $db_connection->prepare($query);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    // Zet state om naar leesbare tekst
                    $roles = [
                        0 => "Klant",
                        1 => "Werknemer",
                        2 => "Admin"
                    ];
                    $stateText = $roles[$user['state']] ?? "Onbekend"; // Fallback als state niet bestaat

                    echo "<tr>
                            <td>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['infix'] ?? '') . " " . htmlspecialchars($user['last_name']) . "</td>
                            <td>" . htmlspecialchars($user['email']) . "</td>
                            <td>" . htmlspecialchars($user['phone_number']) . "</td>
                            <td>" . htmlspecialchars($user['age']) . "</td>
                            <td>" . htmlspecialchars($stateText) . "</td>
                            <td>" . htmlspecialchars($user['worker_name'] ?? 'Onbekend') . "</td>
                          </tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='6'>Fout bij ophalen van gegevens: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
