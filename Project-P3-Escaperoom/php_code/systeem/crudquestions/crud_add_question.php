<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../Styling/style_admin.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
    <title>Escape room</title>
</head>

<body>

    <div class="aanmeldingsformulierDiv">

        <h1>Vraag Toevoegen</h1>
        <form action="" method="POST">
            <label for="vraag">Vraag</label> <br>
            <input type="text" class="inputForm" id="vraag" name="vraag" required></input> <br><br>
            <label for="antwoord">Antwoord</label> <br>
            <input type="text" class="inputForm" id="antwoord" name="antwoord" required></input> <br><br>
        
            <input type="submit" class="submitForm" name="add_vraag" value="Toevoegen">
        </form>
    </div>

    <?php
    include "../../db_connection/dbconn.php";

    if (isset($_POST["add_vraag"])) {
        $vraag = $_POST["vraag"];
        $antwoord = $_POST["antwoord"];
 

        try {
            // Insert de nieuwe vraag en het antwoord in de database
            $query = "INSERT INTO vragen (vraag, antwoord ) VALUES (:vraag, :antwoord)";
            $query_run = $db_connection->prepare($query);

            $data = [
                ":vraag" => $vraag,
                ":antwoord" => $antwoord,
           
            ];

            $query_execute = $query_run->execute($data);

            if ($query_execute) {
                header("Location: manage_questions.php"); // Redirect naar de vraagbeheerpagina
                exit(0);
            } else {
                header("Location: ../../crud_add_vraag.php?error=insert_failed");
                exit(1);
            }
        } catch (PDOException $e) {
            error_log("Database Insert Error: " . $e->getMessage());
            echo "<p>Er is een fout opgetreden. Probeer het opnieuw later.</p>";
            echo $e;
        }
    }

    ?>

</body>
<div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</html>
