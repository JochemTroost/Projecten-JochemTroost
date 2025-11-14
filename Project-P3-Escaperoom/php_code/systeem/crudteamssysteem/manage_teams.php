<?php
include "../../db_connection/dbconn.php";

session_start();

$search = "";
$statusMessage = "";
$searchQuery = "SELECT * FROM teams ORDER BY teamName ASC";
$params = [];

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']);
    $statusMessage = "Zoekresultaten voor: '" . htmlspecialchars($search) . "'";
    $searchQuery = "SELECT * FROM teams WHERE teamName LIKE :search OR namePlayer1 LIKE :search OR namePlayer2 LIKE :search OR namePlayer3 LIKE :search ORDER BY teamName ASC";
    $params = ['search' => "%$search%"];
}


try {
    $query_run = $db_connection->prepare($searchQuery);
    $query_run->execute($params);
    $teams = $query_run->fetchAll(PDO::FETCH_ASSOC);

    if (empty($teams) && !empty($search)) {
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
    <title>Teams Beheren</title>
    <link rel="stylesheet" href="../../../Styling/style_admin.css">
   
    <script>
        let typingTimer;
        
    </script>
</head>
<body>

<div class="container">
    <a href="../master.php" class="btn-back">← Terug</a>
    <h1>Teams Beheren</h1>

    <!-- Zoekformulier -->
    <div class="search-container">
        <input type="text" id="search" name="search" placeholder="Zoek op teamnaam of speler" value="<?php echo htmlspecialchars($search); ?>" onkeyup="searchTeams()">
    </div>

    <?php if ($statusMessage): ?>
        <p class="status-message"><?php echo $statusMessage; ?></p>
    <?php endif; ?>

    <a href="../crudteamssysteem/crud_add_team.php" class="btn-add">+ Team Toevoegen</a>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'delete_failed') : ?>
        <p style="color:red;">Het verwijderen van het team is mislukt. Probeer het opnieuw.</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Teamnaam</th>
                <th>Speler 1</th>
                <th>Speler 2</th>
                <th>Speler 3</th>
                <th>Score</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?php echo htmlspecialchars($team['teamName']); ?></td>
                    <td><?php echo htmlspecialchars($team['namePlayer1']); ?></td>
                    <td><?php echo htmlspecialchars($team['namePlayer2']); ?></td>
                    <td><?php echo htmlspecialchars($team['namePlayer3']); ?></td>
                    <td><?php echo htmlspecialchars($team['score']); ?></td>
                    <td>
                        <a href="edit_team.php?Team_id=<?php echo $team['Team_id']; ?>" class="btn-edit">Bewerken</a>
                        <a href="delete_team.php?Team_id=<?php echo $team['Team_id']; ?>" class="btn-delete" onclick="return confirm('Weet je zeker dat je dit team wilt verwijderen?')">Verwijderen</a>
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