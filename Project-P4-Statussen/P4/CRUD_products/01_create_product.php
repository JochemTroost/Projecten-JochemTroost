<?php
session_start(); // Sessies starten

$statusMsg = $_SESSION["statusMsg"] ?? "";
$statusClass = $_SESSION["statusClass"] ?? "";

if ($_SESSION["state"] == 0) {
    header('location: ../no_access.php');
    exit();
}
// Verwijder de sessievariabelen na het tonen van de melding
unset($_SESSION["statusMsg"]);
unset($_SESSION["statusClass"]);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product aanmaken</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
</head>

<body>
<?php include "../nav.php"; ?> <br>

    <div class="container">
        <h1>Product aanmaken</h1>

        <?php if ($statusMsg): ?>
            <div id="statusMessage" class="status-message <?= $statusClass; ?> show">
                <?= htmlspecialchars($statusMsg); ?>
            </div>
        <?php endif; ?>
        <br>

        <form action="01_s_create_product.php" method="POST">
            
            <label for="name">Productnaam</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Omschrijving</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Prijs (€)</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="state">Status</label>
            <select name="state" id="state" class="inputForm" required>
                <option value="2">Actief</option>
                <option value="1">Inactief</option>
                <option value="0">Geblokkeerd</option>
            </select><br><br>

            <input type="submit" class="submitForm" name="create_product" value="Product toevoegen">
        </form>
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
