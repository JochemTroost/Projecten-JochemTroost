{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/attractions.css?v=1">
{/block}

{block name="content"}
<div class="attractions-page">
  <h1>Attracties</h1>

  {if isset($message) && $message}<p class="message success">{$message|escape}</p>{/if}
  {if isset($error) && $error}<p class="message error">{$error|escape}</p>{/if}

  <nav class="toolbar">
    <a class="btn btn-primary" href="index.php?page=addAttraction">+ Nieuwe attractie</a>
    <a class="btn" href="index.php?page=shopList">Shoplijst</a>
  </nav>

  <table class="table">
    <thead>
      <tr>
        <th>Naam</th>
        <th>Capaciteit</th>
        <th>Status</th>
        <th>Wachttijd (min)</th>
        <th>Acties</th>
      </tr>
    </thead>
    <tbody>
      {foreach from=$attractions item=a}
        <tr>
          <td>{$a->getName()|escape}</td>
          <td>{$a->getCapacity()}</td>
          <td>{$a->getStatus()|escape}</td>
          <td>{$a->getWaitTime()}</td>
          <td class="actions">
            <a class="btn" href="index.php?page=editAttraction&amp;id={$a->getId()}">Bewerken</a>
            <form class="inline" method="post"
                  action="index.php?page=editAttraction&amp;id={$a->getId()}"
                  onsubmit="return confirm('Verwijderen?');">
              <input type="hidden" name="delete" value="1">
              <button class="btn btn-danger" type="submit">Verwijderen</button>
            </form>
          </td>
        </tr>
      {/foreach}
      {if not $attractions}
        <tr><td colspan="5">Nog geen attracties.</td></tr>
      {/if}
    </tbody>
  </table>
</div>
{/block}