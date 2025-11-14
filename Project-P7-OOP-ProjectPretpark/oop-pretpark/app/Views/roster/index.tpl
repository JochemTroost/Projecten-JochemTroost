{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/roster.css?v=1">
{/block}

{block name="content"}
<div class="container roster-page">
  <h1>Rooster bekijken</h1>

  <form class="form roster-filters" method="get">
    <input type="hidden" name="page" value="roster">
    <input type="hidden" name="a" value="index">

    <div class="grid">
      <div>
        <label for="employee_id">Medewerker</label>
        <select name="employee_id" id="employee_id" required>
          <option value="">— kies medewerker —</option>
          {foreach from=$employees item=emp}
            <option value="{$emp->getId()}" {if $selected_employee_id==$emp->getId()}selected{/if}>
              {$emp->getName()|escape}
            </option>
          {/foreach}
        </select>
      </div>

      <div>
        <label for="from">Vanaf</label>
        <input id="from" name="from" type="date" value="{$from}">
      </div>

      <div>
        <label for="to">Tot en met</label>
        <input id="to" name="to" type="date" value="{$to}">
      </div>

      <div class="actions">
        <button class="btn btn-primary" type="submit">Toon rooster</button>
        {if $selected_employee_id}
          <a class="btn" href="index.php?page=employees&amp;a=index">← Terug naar medewerkers</a>
        {/if}
      </div>
    </div>
  </form>

  {if $selected_employee_id}
    <h2>Shifts</h2>
    <div class="table-wrap">
      <table class="table shift-table">
        <thead>
          <tr>
            <th>Datum</th>
            <th>Start</th>
            <th>Einde</th>
            <th>Locatie</th>
          </tr>
        </thead>
        <tbody>
          {assign var=today value=$smarty.now|date_format:"%Y-%m-%d"}
          {foreach from=$shifts item=s}
            <tr class="{if $s->getDate()==$today}is-today{/if}">
              <td>{$s->getDate()}</td>
              <td class="time">{$s->getStart()}</td>
              <td class="time">{$s->getEnd()}</td>
              <td>
                {if $s->getLocation()}
                  <span class="pill">{$s->getLocation()|escape}</span>
                {else}
                  —
                {/if}
              </td>
            </tr>
          {/foreach}
          {if not $shifts}
            <tr><td colspan="4">Geen shifts in deze periode.</td></tr>
          {/if}
        </tbody>
      </table>
    </div>
  {/if}
</div>
{/block}