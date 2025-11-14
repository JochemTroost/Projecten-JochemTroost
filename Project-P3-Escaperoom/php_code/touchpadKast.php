<?php session_start();
if (isset($_SESSION['teamName'])) {
    $teamName = htmlspecialchars($_SESSION['teamName']);
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touchpad</title>
    <link rel="stylesheet" href="../Styling/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passero+One&display=swap" rel="stylesheet">
    
</head >

<body class="body-touchpad">
<h1>Kast Rodrique</h1>
    <div class="touchpad">
        
        <br>
        <input type="text" id="codeInput" class="inputDisplayTouchPad"  readonly> <br>
        <div class="closeComputerScreen" ><a href="../php_code/room1.php">X</a></div>
        <button class="buttonTouchPad" onclick="addNumber(1)">1</button>
        <button class="buttonTouchPad" onclick="addNumber(2)">2</button>
        <button class="buttonTouchPad" onclick="addNumber(3)">3</button>
        <button class="buttonTouchPad" onclick="addNumber(4)">4</button>
        <button class="buttonTouchPad" onclick="addNumber(5)">5</button>
        <button class="buttonTouchPad" onclick="addNumber(6)">6</button>
        <button class="buttonTouchPad" onclick="addNumber(7)">7</button>
        <button class="buttonTouchPad" onclick="addNumber(8)">8</button>
        <button class="buttonTouchPad" onclick="addNumber(9)">9</button>
        <button class="buttonTouchPad" onclick="clearInput()">C</button>
        <button class="buttonTouchPad" onclick="addNumber(0)">0</button>
        <button class="buttonTouchPad" onclick="checkCode()">#</button>
    </div>

    <script src="../javascript_code/app.js" ></script>
</body>

</html>