<?php
session_start();
require "../dbconn.php";
$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";

// Verwijder de sessievariabelen na het tonen van de melding
unset($_SESSION["statusMsg"]);
unset($_SESSION["statusClass"]);
// Controleer of de gebruiker werknemer of admin is
if (!isset($_SESSION["state"])) {
    header('location: ../no_access.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productenoverzicht</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <?php include "../nav.php"; ?>

    <br>
    <div class="container">
        <h1>Productenoverzicht</h1>


        <?php if ($statusMsg): ?>
            <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
                <?= htmlspecialchars($statusMsg); ?>
            </div>
        <?php endif; ?>
        <a href="../CRUD_products/01_create_product.php" class="btn btn-primary">Product toevoegen</a>

        <table border="1">
            <tr>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Omschrijving</th>
                <?php if (($_SESSION["state"] == 1) || ($_SESSION["state"] == 2)): ?>
                    <th>Status</th>
                <?php endif; ?>
                <th>Acties</th>
            </tr>
            <?php
            try {
                $query = "SELECT * FROM products ORDER BY state DESC, name ASC";
                $stmt = $db_connection->prepare($query);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($products as $product) {
                    // Status bepalen en CSS-klassen toewijzen
                    if ($product['state'] == 0) {
                        $status = "<span class='status-geblokkeerd'>Geblokkeerd</span>";
                    } elseif ($product['state'] == 2) {
                        $status = "<span class='status-actief'>Actief</span>";
                    } else {
                        $status = "<span class='status-inactief'>Inactief</span>";
                    }

                    echo "<tr>
                            <td>" . htmlspecialchars($product['name']) . "</td>
                            <td>€ " . htmlspecialchars($product['price']) . "</td>
                            <td>" . htmlspecialchars($product['description']) . "</td>";

                    if (($_SESSION["state"] == 1) || ($_SESSION["state"] == 2)) {
                        echo "<td>" . $status . "</td>";
                    }

                    echo "<td class='tdRight'>";

                    echo "<form action='00_read_product.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $product['product_id'] . "'>
                            <button type='submit' class='btn'>Bekijk</button>
                          </form>";

                    if (($_SESSION["state"] == 1) || ($_SESSION["state"] == 2)) {
                        echo "<form action='01_update_product.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id' value='" . $product['product_id'] . "'>
                                <button type='submit' class='btn'>Bewerk</button>
                              </form>";

                        echo "<form action='01_s_delete_product.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Weet je zeker dat je dit product (" . $product['name'] . ") wilt verwijderen?\")'>
                                <input type='hidden' name='id' value='" . $product['product_id'] . "'>
                                <button type='submit' name='action' value='delete' class='btn'>Verwijderen</button>
                              </form>";
                    } 

                    echo "</td>
                          </tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='5'>Fout bij ophalen van gegevens: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </table>
    </div>
    <script>
        setTimeout(() => {
            const statusMessage = document.getElementById("statusMessage");
            if (statusMessage) {
                statusMessage.style.display = "none";
            }
        }, 3000);
    </script>
</body>

</html>