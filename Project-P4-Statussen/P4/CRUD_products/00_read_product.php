<?php
session_start();
require "../dbconn.php";

if (!isset($_SESSION["state"])) {
    header('location: ../no_access.php');
    exit();
}
// Controleer of er een ID is meegegeven via POST
if (isset($_POST['id'])) {
    $id = $_POST['id']; // De ID van het product dat we willen bekijken
} else {
    echo "<p>Geen product geselecteerd.</p>";
    exit();
}

try {
    // Ophalen van de productgegevens op basis van de ID
    $query = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->execute([':id' => $id]);
    $product_array = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product_array) {
        echo "<p>Product niet gevonden.</p>";
        exit();
    }

    // Variabelen vullen met de opgehaalde gegevens
    $name = $product_array["name"];
    $price = $product_array["price"];
    $state = $product_array["state"];
    $create_date = $product_array["create_date"];

    // Bepaal de status op basis van de waarde van 'state'
    if ($state == 0) {
        $status = "Geblokkeerd";
    } elseif ($state == 1) {
        $status = "Actief";
    } else {
        $status = "Inactief"; // Als je een andere status hebt toegevoegd
    }

} catch (PDOException $e) {
    error_log("Database Fetch Error: " . $e->getMessage());
    echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bekijken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
    <h1>Productgegevens Bekijken</h1>
    <form>
      
        <h2><br><?php echo htmlspecialchars($name);?><br>
        
        <label for="price">Prijs</label> <br>
        <input type="number" class="inputForm" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" readonly><br><br>
        
        <label for="status">Status</label> <br>
        <input type="text" class="inputForm" id="status" name="status" value="<?php echo htmlspecialchars($status); ?>" readonly><br><br>
        
        <label for="create_date">Aangemaakt op</label> <br>
        <input type="text" class="inputForm" id="create_date" name="create_date" value="<?php echo htmlspecialchars($create_date); ?>" readonly><br><br>
    </form>
</div>

</body>
</html>
