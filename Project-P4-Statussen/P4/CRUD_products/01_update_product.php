<?php
session_start();
require "../dbconn.php";

if ($_SESSION["state"] == 0) {
    header('location: ../no_access.php');
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id']; // De ID van het product dat we willen bekijken
} else {
    echo "<p>Geen product geselecteerd.</p>";
    exit();
}

try {
    // Ophalen van het product op basis van de ID
    $query = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<p>Product niet gevonden.</p>";
        exit();
    }

    // Variabelen vullen met de opgehaalde gegevens
    $name = $product["name"];
    $description = $product["description"];
    $price = $product["price"];
    $state = $product["state"];
} catch (PDOException $e) {
    error_log("Database Fetch Error: " . $e->getMessage());
    echo "<p>Er is een fout opgetreden. Probeer het opnieuw later. </p>";
    echo $e;
    exit();
}

// Bijwerken van de productgegevens
if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $state = $_POST['state']; // Status ophalen uit het formulier

    try {
        $query = "UPDATE products 
                  SET name = :name, description = :description, price = :price, state = :state
                  WHERE product_id = :id";
        $stmt = $db_connection->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':state' => $state,
            ':id' => $id
        ]);

        header("Location: 00_read_products.php"); // Redirect naar de productbeheerpagina
        exit();
    } catch (PDOException $e) {
        error_log("Database Update Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bewerken</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include "../nav.php"; ?>

    <div class="container">
        <h1>Product Bewerken</h1>
        <form action="01_update_product.php" method="POST">
            <!-- ID wordt via POST meegestuurd -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="name">Productnaam</label> <br>
            <input type="text" class="inputForm" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

            <label for="description">Beschrijving</label> <br>
            <textarea class="inputForm" id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea><br><br>

            <label for="price">Prijs (€)</label> <br>
            <input type="number" class="inputForm" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required><br><br>

            <label for="state">Status</label> <br>
            <select name="state" id="state" class="inputForm" required>
                <option value="2" <?php echo ($state == 2) ? 'selected' : ''; ?>>Actief</option>
                <option value="1" <?php echo ($state == 1) ? 'selected' : ''; ?>>Inactief</option>
                <option value="0" <?php echo ($state == 0) ? 'selected' : ''; ?>>Geblokkeerd</option>
            </select><br><br>

            <input type="submit" class="submitForm" name="update_product" value="Bijwerken">
        </form>
    </div>
</body>

</html>
