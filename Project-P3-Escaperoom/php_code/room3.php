<?php
// Verbinding maken met de database
include "../php_code/db_connection/dbconn.php";

 session_start();
if (isset($_SESSION['teamName'])) {
    $teamName = htmlspecialchars($_SESSION['teamName']);
}
try {
    $db_connection = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Haal de vragen op uit de database
    $query = $db_connection->prepare("SELECT vraag_id, vraag FROM vragen");
    $query->execute();
    $vragen = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape Room Krant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 20px;
            background: #f3f3f3;
        }
        .krant {
            width: 800px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            display: flex;
        }
        .artikel {
            width: 70%;
            padding-right: 20px;
        }
        .menu {
            width: 30%;
            background: #f9f9f9;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .menu a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            text-align: center;
        }
        .menu a:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
<div class="topBar">


<div class="topBar">
    <div class="teamName">
        <h1 class="teamName"><strong> <?= $teamName ?> </strong> </h1>
    </div>


    <div class="time">
        <h1 id="countdown-timer" class="time"></h1>
    </div>
</div>

</div>
    <div class="krant">
        <div class="artikel">
            <h1>De Dagelijkse Nieuwsbrief</h1>
            <h2>Breaking News: Mysterieus Verhaal Ontvouwt Zich!</h2>
            <p>Er is meer informatie bekent over rodrique friedrich. hieronder staan vragen die beantwoord moeten worden. Als je alle vragen correct kan beantwoorden ontsnap je aan rodrique friedrich.</p>
            
            <h3>Gedeelde informatie:</h3>
            <form id="vragenForm">
                <?php foreach ($vragen as $vraag): ?>
                    <label><?= htmlspecialchars($vraag['vraag']) ?></label>
                    <input type="text" name="vraag_<?= $vraag['vraag_id'] ?>" placeholder="Jouw antwoord...">
                <?php endforeach; ?>
                <button type="submit">Controleer Antwoorden</button>
            </form>
        </div>
        <div class="menu">
            <h2>Menu</h2>

            <a href="room1.php">Ga naar Room 1</a>
            <a href="room2.php">Ga naar Room 2</a>
            <p>LET OP!! Als je terug gaat naar een ruimte zal je eerst de puzzel weer moeten invullen. je kan dus alleen terug met het correcte antwoord.</p>
        </div>
    </div>

    <script>
       document.getElementById('vragenForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const formData = new FormData(e.target);
  const antwoorden = {};
  formData.forEach((value, key) => {
      const vraag_id = key.split('_')[1];
      antwoorden[vraag_id] = value;
  });

  const response = await fetch('check_antwoorden.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(antwoorden)
  });

  const resultaat = await response.json();
  
  // Controleer op redirect
  if (resultaat.redirect) {
      window.location.href = resultaat.redirect;
  } else {
      alert("Helaas! 1 of meerdere andwoorden zijn niet correct.");
  }
}); 
    </script>
</body>
</html>
