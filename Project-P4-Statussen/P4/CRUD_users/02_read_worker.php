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
    <title>Medewerkersoverzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../nav.php"; ?>

    <div class="container">
        <h1>Medewerkersoverzicht</h1>
        <a href="../CRUD_users/02_create_user.php" class="btn btn-primary">Gebruiker toevoegen</a>

        <table border="1">
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
            <?php
            try {
                $query = "SELECT * FROM registrations WHERE state IN(1, 2) ORDER BY first_name ASC";
                $stmt = $db_connection->prepare($query);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    if ($user['state'] == 1) {
                        $status = 'Werknemer';
                    } elseif ($user['state'] == 2) {
                        $status = 'Admin';
                    } else {
                        $status = 'Onbekend';
                    }

                    echo "<tr>
                            <td>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['infix']) . " " . htmlspecialchars($user['last_name']) . "</td>
                            <td>" . htmlspecialchars($user['email']) . " </td>
                            <td>" . $status . "</td>
                            <td>
                                <form action='01_read_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $user['id'] . "'>
                                    <button type='submit' class='btn'>Bekijk</button>
                                </form>
                                <form action='02_update_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $user['id'] . "'>
                                    <button type='submit' class='btn'>Bewerk</button>
                                </form>";

                    if ($_SESSION["state"] == 2) {
                        echo "<form action='02_s_delete_user.php' method='post' style='display:inline;' onsubmit='return confirm(\"Weet je zeker dat je deze klant wilt verwijderen?\")'>
                                <input type='hidden' name='id' value='" . $user['id'] . "'>
                                <button type='submit' name='action' value='delete' class='btn btn-danger'>Verwijderen</button>
                              </form>";
                    }

                    echo "</td>
                        </tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='4'>Fout bij ophalen van gegevens: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
