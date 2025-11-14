<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Login</title>
    <link href="../../Styling/style_admin.css" rel="stylesheet">
</head>

<body class="body-master">

    <div class="container-master">
        <button class="back-button" onclick="goBack()">Terug</button>
        <h2>Admin Login</h2>
        <input type="password" id="password" placeholder="Voer wachtwoord in">
        <button onclick="checkLogin()">Inloggen</button>
        <p id="loginMessage" class="message"></p>
    </div>

    <script src="../../javascript_code/room1.js"></script>

</body>
<div class="footer">
        &copy; 2025 Jochem Troost | Alle rechten voorbehouden
    </div>
</html>