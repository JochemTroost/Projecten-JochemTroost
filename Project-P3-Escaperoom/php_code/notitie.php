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


    <title>Escape room</title>
</head>

<body class="bodyRoom1">
    <div class="topBar">


        <div class="topBar">
            <div class="teamName">
                <h1 class="teamName"><strong> <?= $teamName ?> </strong> </h1>
            </div>


            <div class="time">
                <h1 id="timer" class="time"></h1>
            </div>
        </div>

    </div>
  <a href="room1.php">  <img class="notitie" id="notitie" src="../Styling/img/notitie.png" alt="notitie"></a>
 


</body>

</html>