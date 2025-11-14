<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Pretpark Dashboard</title>
  <link rel="stylesheet" href="assets/css/home.css?v=1">
</head>
<body>
  <h1>Pretpark Dashboard</h1>

  <div class="alerts">
    {if isset($message) && $message}<p class="ok">{$message|escape}</p>{/if}
    {if isset($error) && $error}<p class="err">{$error|escape}</p>{/if}
  </div>

  <div class="grid">
    <a class="card" href="index.php?page=shopList">
      <h2 class="title">Shopbeheer</h2><p class="muted">Overzicht & beheer</p>
    </a>
    <a class="card" href="index.php?page=attractionList">
      <h2 class="title">Attractiebeheer</h2><p class="muted">Overzicht & beheer</p>
    </a>
    <a class="card" href="index.php?page=employees&a=index">
      <h2 class="title">Medewerkers</h2><p class="muted">Toevoegen/bewerken/verwijderen</p>
    </a>
    <a class="card" href="index.php?page=roster&a=index">
      <h2 class="title">Rooster</h2><p class="muted">Shifts bekijken</p>
    </a>
    <a class="card" href="index.php?page=reserveTicket">
      <h2 class="title">Tickets reserveren</h2><p class="muted">Visitor portal</p>
    </a>
    <a class="card" href="index.php?page=visitorList">
      <h2 class="title">Bezoekersoverzicht</h2><p class="muted">Inschrijvingen</p>
    </a>
    <a class="card" href="index.php?page=monthlyStats">
      <h2 class="title">Reserveringsstatistieken</h2><p class="muted">Rapportage</p>
    </a>
  </div>
</body>
</html>