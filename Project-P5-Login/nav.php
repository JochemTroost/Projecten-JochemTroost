
<?php

$firstname = $_SESSION['name'] ?? 'Gebruiker';
?>

<nav class="navbar">
  <div class="logo">JTS Dashboard</div>
  <div class="nav-buttons">
    
 
 
    <?php if (!isset($_SESSION['user_id'])): ?> 
      <a href="/dashboard/crud_users/login.php" class="btn btn-outline">Inloggen</a>
      <a href="/dashboard/crud_users/register.php" class="btn ">Registreren</a>
    <?php else: ?>
         <p><strong><?php echo $firstname ?>  </strong></p>
      <a href="/dashboard/crud_users/settings.php" class="btn btn-outline">Instellingen</a>
      <a href="/dashboard/crud_users/logout.php" class="btn btn-outline">Uitloggen</a>
    <?php endif; ?>
  </div>
</nav>
