<?php if (isset($_SESSION["state"])): ?>

    <?php if (($_SESSION["state"] == 1) || ($_SESSION["state"] == 2)): ?>
        <div class="navbar">
            <div>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/index.php">Home</a>
          
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_products/00_read_products.php">Productenoverzicht</a>

                <?php if ($_SESSION["state"] == 2): ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php">Klantenoverzicht</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/02_read_worker.php">Medewerkersoverzicht</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/02_user_history.php">Gebruikersgeschiedenis</a>
                <?php else: ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/01_read_client.php">Klantenoverzicht</a>
                <?php endif; ?>
            </div>

            <div>
                <?php if (isset($_SESSION["id"])): ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/acc.php">Account</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/logout.php">Uitloggen</a>
                <?php else: ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/login.php">Inloggen</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php">Registreren</a>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="navbar">
            <div>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/index.php">Home</a>
     
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_products/00_read_products.php">Productenoverzicht</a>
            </div>
            <div>
                <?php if (isset($_SESSION["id"])): ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/acc.php">Account</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/logout.php">Uitloggen</a>
                <?php else: ?>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/login.php">Inloggen</a>
                    <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php">Registreren</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <div class="navbar">
        <div>
            <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/index.php">Home</a>
       
        </div>
        <div>
            <?php if (isset($_SESSION["id"])): ?>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/acc.php">Account</a>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/logout.php">Uitloggen</a>
            <?php else: ?>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/login.php">Inloggen</a>
                <a href="../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php">Registreren</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>