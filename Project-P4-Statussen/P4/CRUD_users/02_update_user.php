<?php
session_start();
require "../dbconn.php";

// Controleer of er een ID is meegegeven via POST
if (isset($_POST['id'])) {
    $id = $_POST['id']; // De ID van de klant die bewerkt moet worden
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
    $state = $user_array["state"];  // Dit is de 'state' van de klant
} catch (PDOException $e) {
    error_log("Database Fetch Error: " . $e->getMessage());
    echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
    exit();
}

// Bijwerken van de klantgegevens
if (isset($_POST['update_user'])) {
    $first_name = $_POST['first_name'];
    $infix = $_POST['infix'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $state = $_POST['state']; // Het nieuwe state wordt opgehaald uit het formulier

    try {
        $query = "UPDATE registrations 
                  SET first_name = :first_name, infix = :infix, last_name = :last_name, 
                      age = :age, email = :email, phone_number = :phone_number, state = :state 
                  WHERE id = :id";
        $stmt = $db_connection->prepare($query);
        $stmt->execute([
            ':first_name' => $first_name,
            ':infix' => $infix,
            ':last_name' => $last_name,
            ':age' => $age,
            ':email' => $email,
            ':phone_number' => $phone_number,
            ':state' => $state,  // De status wordt ook geüpdatet
            ':id' => $id
        ]);

        header("Location: ../index.php"); // Redirect naar klantenbeheer
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
    <title>Klant Bewerken</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include "../nav.php"; ?>

    <div class="container">
        <h1>Klantgegevens Bewerken</h1>
        <form action="02_update_user.php" method="POST">
            <!-- ID wordt via POST meegegeven -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="first_name">Voornaam</label> <br>
            <input type="text" class="inputForm" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required><br><br>

            <label for="infix">Tussenvoegsel</label> <br>
            <input type="text" class="inputForm" id="infix" name="infix" value="<?php echo htmlspecialchars($infix); ?>"><br><br>

            <label for="last_name">Achternaam</label> <br>
            <input type="text" class="inputForm" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required><br><br>

            <label for="age">Leeftijd</label> <br>
            <input type="number" class="inputForm" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required><br><br>

            <label for="email">E-mail</label> <br>
            <input type="email" class="inputForm" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

            <label for="phone_number">Telefoonnummer</label> <br>
            <input type="text" class="inputForm" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" required><br><br>

            <?php if ($_SESSION["state"] == 2): ?>
                <label for="state">Status</label> <br>
                <select name="state" id="state" class="inputForm" required>
                    <option value="1" <?php echo ($state == 1) ? 'selected' : ''; ?>>Werknemer</option>
                    <option value="2" <?php echo ($state == 2) ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo ($state == 0) ? 'selected' : ''; ?>>Klant</option>
                </select><br><br>
            <?php endif; ?>
            
            <input type="submit" class="submitForm" name="update_user" value="Bijwerken">
        </form>
    </div>
</body>

</html>
