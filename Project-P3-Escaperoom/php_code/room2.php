<?php session_start();
if (isset($_SESSION['teamName'])) {
    $teamName = htmlspecialchars($_SESSION['teamName']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Styling/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
    <title>Escape Room</title>



</head>

<body class="bodyRoom2">
    <div class="Room2-title">Zoek letters en los de puzzel op.</div>

    <form method="POST">
        <input class="Room2-title-input" id="Room2-title-input" type="text" name="userInput" >
        <button type="submit" class="submit-button">Controleer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userInput = strtoupper(trim($_POST['userInput'])); // Verwijder spaties en zet om naar hoofdletters
        if ($userInput === "RODRIQUE GEVLUCHT") {
            header("Location: room3.php");
            exit();
        } else {
            
        }
    }

    $letters = ['R', 'O', 'D', 'R', 'I', 'Q', 'U', 'E', 'G', 'E', 'V', 'L', 'U', 'C', 'H', 'T'];
    $positions = [];

    function checkOverlap($x, $y, $positions)
    {
        foreach ($positions as $pos) {
            $dx = abs($x - $pos['x']);
            $dy = abs($y - $pos['y']);
            if ($dx < 8 && $dy < 8) { 
                return true;
            }
        }
        return false;
    }

    foreach ($letters as $letter) {
        do {
            $x = rand(10, 85); 
            $y = rand(25, 75); 
        } while (checkOverlap($x, $y, $positions));

        $positions[] = ['x' => $x, 'y' => $y];

        echo "<div class='Room2Letter' style='left: {$x}vw; top: {$y}vh;'>$letter</div>";
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const letters = document.querySelectorAll(".Room2Letter");

            letters.forEach(letter => {
                letter.addEventListener("mouseover", function() {
                    this.style.color = "rgb(38, 38, 38)";
                });
            });
        });
    </script>
</body>

</html>
