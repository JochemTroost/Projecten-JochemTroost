<?php
include "../../db_connection/dbconn.php";

session_start();

$search = "";
$statusMessage = "";
$searchQuery = "SELECT * FROM vragen ORDER BY vraag ASC";
$params = [];

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']);
    $statusMessage = "Zoekresultaten voor: '" . htmlspecialchars($search) . "'";
    $searchQuery = "SELECT * FROM vragen WHERE vraag LIKE :search OR antwoord LIKE :search ORDER BY vraag ASC";
    $params = ['search' => "%$search%"];
}

// Ophalen van vragen
try {
    $query_run = $db_connection->prepare($searchQuery);
    $query_run->execute($params);
    $vragen = $query_run->fetchAll(PDO::FETCH_ASSOC);

    if (empty($vragen) && !empty($search)) {
        $statusMessage = "Geen resultaten gevonden voor: '" . htmlspecialchars($search) . "'";
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
    <title>Vragen Beheren</title>
    <link rel="stylesheet" href="../../../Styling/style_admin.css">
</head>
<body>

<div class="container">
    <a href="../master.php" class="btn-back">← Terug</a>
    <h1>Vragen Beheren</h1>

    <!-- Zoekformulier -->
    <div class="search-container">
        <input type="text" id="search" name="search" placeholder="Zoek op vraag of antwoord" value="<?php echo htmlspecialchars($search); ?>" onkeyup="searchQuestions()">
    </div>

    <?php if ($statusMessage): ?>
        <p class="status-message"><?php echo $statusMessage; ?></p>
    <?php endif; ?>

    <a href="../crudquestions/crud_add_question.php" class="btn-add">+ Vraag Toevoegen</a>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'delete_failed') : ?>
        <p style="color:red;">Het verwijderen van de vraag is mislukt. Probeer het opnieuw.</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Vraag</th>
                <th>Antwoord</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vragen as $vraag): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vraag['vraag']); ?></td>
                    <td><?php echo htmlspecialchars($vraag['antwoord']); ?></td>
                    <td>
                        <a href="edit_question.php?vraag_id=<?php echo $vraag['vraag_id']; ?>" class="btn-edit">Bewerken</a>
                        <a href="delete_question.php?vraag_id=<?php echo $vraag['vraag_id']; ?>" class="btn-delete" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="../../../javascript_code/room1.js" ></script>
<div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</body>
</html>
