<?php
session_start();
require "../dbconn.php";

// Controleer of de gebruiker werknemer of admin is
if ($_SESSION["state"] == 0) {
    header('location: ../no_access.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klantenoverzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
    <h1>Klantenoverzicht</h1>

    <!-- Knop om een nieuwe klant toe te voegen -->
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
            // Haal alle klanten op (state = 0)
            $query = "SELECT * FROM registrations WHERE state = 0 ORDER BY first_name ASC";
            $stmt = $db_connection->prepare($query);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($clients as $client) {
                echo "<tr>
                        <td>" . htmlspecialchars($client['first_name']) . " " . htmlspecialchars($client['infix']) . " " . htmlspecialchars($client['last_name']) . "</td>
                        <td>" . htmlspecialchars($client['email']) . " </td>
                        <td>Klant</td>
                        <td>";

                // Formulier voor 'Bekijk' actie
                echo "<form action='01_read_user.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $client['id'] . "'>
                        <button type='submit' class='btn'>Bekijk</button>
                      </form>";

                // Formulier voor 'Bewerk' actie
                echo "<form action='02_update_user.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $client['id'] . "'>
                        <button type='submit' class='btn'>Bewerk</button>
                      </form>";

                // Alleen tonen als de gebruiker een admin is
             
                    // Formulier voor 'Verwijder' actie
                    echo "<form action='02_s_delete_user.php' method='post' style='display:inline;' onsubmit='return confirm(\"Weet je zeker dat je deze klant wilt verwijderen?\")'>
                            <input type='hidden' name='id' value='" . $client['id'] . "'>
                            <button type='submit' name='action' value='delete' class='btn btn-danger'>Verwijderen</button>
                          </form>";
                

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
