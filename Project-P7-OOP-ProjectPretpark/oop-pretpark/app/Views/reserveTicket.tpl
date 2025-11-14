{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/visitor.css">
{/block}

{block name="content"}
<h1>Reserveer een ticket</h1>

{if $message}<p class="message">{$message nofilter}</p>{/if}
{if $error}<p class="error">{$error}</p>{/if}

<form method="post" action="index.php?page=reserveTicket">
  <label>Naam:</label>
  <input type="text" name="name" required>

  <label>E-mail:</label>
  <input type="email" name="email" required>

  <label>Bezoekdatum:</label>
  <input type="date" name="visit_date" required>

  <label>Ticket type:</label>
  <select name="ticket_type" required>
    <option value="">-- Kies type --</option>
    {foreach $ticketTypes as $type => $price}
      <option value="{$type}">{$type} (€{$price})</option>
    {/foreach}
  </select>

  <label>Aantal personen:</label>
  <input type="number" name="persons" min="1" value="1" required>
  <br>

  <button type="submit">Reserveer</button>
</form>

<p class="hint">De totaalprijs wordt berekend nadat je het formulier indient.</p>
{/block}