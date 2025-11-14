<?php session_start();
if (isset($_SESSION['teamName'])) {
    $teamName = htmlspecialchars($_SESSION['teamName']);
}

if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // Slaat de huidige tijd op
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
    


    <title>Escape room</title>
</head>

<body class="bodyRoom1">
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
    <img class="room1" id="room1" src="../Styling/img/room1.jpeg" alt="room1">
    <div id="room1JasnaPasje" class="room1JasnaPasje"></div>
    <div id="room1Notitie" class="room1Notitie"></div>
    <div id="room1Blood" class="room1Blood"></div>
    <div id="computerScreen" class="computerScreen"></div>
    <div id="touchPadDiv" class="touchPadDiv"></div>
    <div id="room1Kast" class="room1Kast"></div>
    <div id="room1NotitieRo" class="room1NotitieRo"></div>
    <script src="../../Project-p3-Escaperoom/javascript_code/room1.js"> </script>
</body>

</html>