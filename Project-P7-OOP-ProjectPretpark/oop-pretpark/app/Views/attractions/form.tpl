{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/attractions.css?v=1">
{/block}

{block name="content"}
<div class="attractions-page">
  <h1>{if $isEdit}Attractie bewerken{else}Nieuwe attractie{/if}</h1>

  <nav class="toolbar">
    <button type="button" class="back-link" onclick="location.href='index.php?page=attractionList'">
      &larr; Terug naar lijst
    </button>
  </nav>

  {if isset($message) && $message}<p class="message success">{$message|escape}</p>{/if}
  {if isset($error) && $error}<p class="message error">{$error|escape}</p>{/if}

  {assign var=st value='closed'}
  {if $isEdit}{assign var=st value=$attraction->getStatus()}{/if}

  <form class="form" method="post" action="index.php?page={if $isEdit}editAttraction&amp;id={$attraction->getId()}{else}addAttraction{/if}">
    <fieldset class="box">
      <legend>Basisgegevens</legend>
      <div class="group">
        <div>
          <label for="name">Naam</label>
          <input id="name" name="name" type="text" required
                 value="{if $isEdit}{$attraction->getName()|escape}{else}{$smarty.post.name|default:''|escape}{/if}">
        </div>

        <div>
          <label for="capacity">Capaciteit</label>
          <input id="capacity" name="capacity" type="number" min="1" required
                 value="{if $isEdit}{$attraction->getCapacity()}{else}{$smarty.post.capacity|default:1}{/if}">
        </div>

        <div>
          <label for="status">Status</label>
          <select id="status" name="status" required>
            <option value="open"        {if $st eq 'open'}selected{/if}>open</option>
            <option value="closed"      {if $st eq 'closed'}selected{/if}>closed</option>
            <option value="maintenance" {if $st eq 'maintenance'}selected{/if}>maintenance</option>
          </select>
        </div>

        <div>
          <label for="wait_time">Wachttijd (minuten)</label>
          <input id="wait_time" name="wait_time" type="number" min="0" required
                 value="{if $isEdit}{$attraction->getWaitTime()}{else}{$smarty.post.wait_time|default:0}{/if}">
        </div>
      </div>
    </fieldset>

    <div class="toolbar">
      <div></div>
      <div class="actions">
        <button class="btn btn-primary" type="submit">{if $isEdit}Opslaan{else}Toevoegen{/if}</button>
        <a class="btn" href="index.php?page=attractionList">Annuleren</a>
      </div>
    </div>
  </form>
</div>
{/block}