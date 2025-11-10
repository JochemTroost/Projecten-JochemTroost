<?php
session_start();
require "../dbconn.php";

// Controleer of er een ID is meegegeven via POST
if (isset($_POST['id'])) {
    $id = $_POST['id']; // De ID van de klant die we willen bekijken
} else {
    echo "<p>Geen klant geselecteerd.</p>";
    exit();
}

try {
    // Ophalen van de klantgegevens op basis van de ID
    $query = "SELECT * FROM registrations WHERE id = :id";
    $stmt = $db_connection->prepare($query);
    $stmt->execute([':id' => $id]);
    $user_array = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user_array) {
        echo "<p>Klant niet gevonden.</p>";
        exit();
    }

    // Variabelen vullen met de opgehaalde gegevens
    $first_name = $user_array["first_name"];
    $infix = $user_array["infix"];
    $last_name = $user_array["last_name"];
    $age = $user_array["age"];
    $email = $user_array["email"];
    $phone_number = $user_array["phone_number"];
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
    <title>Gegevens Bekijken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
    <h1>gegevens Bekijken</h1>
    <form>
        <label for="first_name">Voornaam</label> <br>
        <input type="text" class="inputForm" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" readonly><br><br>
        
        <label for="infix">Tussenvoegsel</label> <br>
        <input type="text" class="inputForm" id="infix" name="infix" value="<?php echo htmlspecialchars($infix); ?>" readonly><br><br>
        
        <label for="last_name">Achternaam</label> <br>
        <input type="text" class="inputForm" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" readonly><br><br>
        
        <label for="age">Leeftijd</label> <br>
        <input type="number" class="inputForm" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" readonly><br><br>
        
        <label for="email">E-mail</label> <br>
        <input type="email" class="inputForm" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly><br><br>
        
        <label for="phone_number">Telefoonnummer</label> <br>
        <input type="text" class="inputForm" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" readonly><br><br>
    </form>
</div>
</body>
</html>
