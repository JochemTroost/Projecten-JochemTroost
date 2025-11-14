
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vraag Bewerken</title>
    <link rel="stylesheet" href="../../../Styling/style_admin.css">
</head>
<body>
<?php
include "../../db_connection/dbconn.php";

if (isset($_GET['vraag_id'])) {
    $vraagId = $_GET['vraag_id'];


    try {
        // Ophalen van de vraag op basis van de ID
        $query = "SELECT * FROM vragen WHERE vraag_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([':id' => $vraagId]);
        $vraag_array = $query_run->fetch(PDO::FETCH_ASSOC);
        $vraag = $vraag_array["vraag"];
        $vraagId = $vraag_array["vraag_id"];
        $antwoord = $vraag_array["antwoord"];
    } catch (PDOException $e) {
        error_log("Database Fetch Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
        echo $e ;
        exit();
    }

    if (!$vraag_array) {
        echo "<p>Vraag niet gevonden.</p>";
        exit();
    }
}

if (isset($_POST['update_vraag'])) {
    // Gegevens ophalen uit formulier
    $vraag = $_POST['vraag'];
    $antwoord = $_POST['antwoord'];
    $vraagId = $_POST['vraag_id'];

    try {
        $query = "UPDATE vragen SET vraag = :vraag, antwoord = :antwoord WHERE vraag_id = :id";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([
            ':vraag' => $vraag,
            ':antwoord' => $antwoord,
            ':id' => $vraagId
        ]);

        header("Location: manage_questions.php"); // Je kunt de redirect aanpassen naar de juiste pagina voor vraagbeheer
        exit(0);
    } catch (PDOException $e) {
        error_log("Database Update Error: " . $e->getMessage());
        echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
    }
}
?>

    <div class="container">
        <h1>Vraag Bewerken</h1>
    

        <form action="edit_question.php" method="POST">

            <input type="hidden" name="vraag_id" value="<?php echo $vraagId; ?>">
            <label for="vraag">Vraag</label> <br>
            <input type="text" class="inputForm" id="vraag" name="vraag" value="<?php echo $vraag; ?>" required></input> <br><br>
            <label for="antwoord">Antwoord</label> <br>
            <input type="text" class="inputForm" id="antwoord" name="antwoord" value="<?php echo $antwoord; ?>" required></input> <br><br>
            <input type="submit" class="submitForm" name="update_vraag" value="bijwerken">
        </form>
    </div>
    <div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</body>
</html>
