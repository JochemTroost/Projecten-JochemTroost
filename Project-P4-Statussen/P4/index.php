<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broodgroothandel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "nav.php"; ?>

    <div class="hero">
        <h1>Welkom bij De Project Website van P4</h1>
        <?php if (isset($_SESSION["state"])) {
            echo "<h2>Welkom " . $_SESSION["first_name"] . "</h2>";
        } ?>

        <section class="about">
            <h2>Rollen</h2>
            <p>Er zijn op de website verschillende rollen met verschillende machtegingen</p>
            <table border="1">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>E-mail</th>
                        <th>Wachwoord</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Klant</td>
                        <td>Klant@klant.com</td>
                        <td>0000</td>
                    </tr>
                    <tr>
                        <td>Medewerker</td>
                        <td>worker@worker.com</td>
                        <td>0000</td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                        <td>admin@admin.com</td>
                        <td>0000</td>
                    </tr>
                </tbody>
            </table>

        

        </section>
        <div class="rollen-container">
            
            <ul>
            <h2>Wat kunnen de rollen</h2>
                <p><strong>Niet ingelogd</strong></p>
                <li>Inloggen</li>
                <li>Registreren</li>
                <li>Homepagina bekijken</li>

                <p><strong>Klant</strong></p>
                <li>Uitloggen als klant</li>
                <li>De homepage en productpagina zien</li>
                <li>Accountgegevens bekijken maar niet wijzigen</li>
                <li>Wachtwoord wijzigen</li>

                <p><strong>Werknemer</strong></p>
                <li>Uitloggen als Werknemer</li>
                <li>De homepage en productpagina zien</li>
                <li>Producten toevoegen, wijzigen en verwijderen</li>
                <li>Status van het product aanpassen</li>
                <li>Accountgegevens van klanten bekijken wijzigen en verwijderen</li>
                <li>klanten registreren</li>
                <li>Accountgegevens bekijken maar niet wijzigen</li>
                <li>Wachtwoord wijzigen</li>

                <p><strong>Admin</strong></p>
                <li>Uitloggen als admin</li>
                <li>De homepage en productpagina zien</li>
                <li>Producten toevoegen, wijzigen en verwijderen</li>
                <li>Status van het product aanpassen</li>
                <li>Accountgegevens van klanten en werknemers bekijken wijzigen en verwijderen</li>
                <li>Status van klanten en werknemers wijzigen</li>
                <li>klanten en werknemers registreren</li>
                <li>Accountgegevens bekijken en wijzigen</li>
                <li>Gebruikersgeschiedenis bekijken</li>
                <li>Wachtwoord wijzigen</li>
            </ul>
        </div>



</body>

</html>