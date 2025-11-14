{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/visitor.css?v=2">
{/block}

{block name="content"}
<div class="stats-page">
  <h1>Maandoverzicht bezoekers</h1>

  <form class="form stats-filters" method="get" action="index.php">
    <input type="hidden" name="page" value="monthlyStats">
    <div class="grid">
      <div>
        <label for="month">Maand</label>
        <select name="month" id="month">
          {foreach $months as $mKey => $mName}
            <option value="{$mKey}" {if $mKey == $month}selected{/if}>{$mName}</option>
          {/foreach}
        </select>
      </div>

      <div>
        <label for="year">Jaar</label>
        <select name="year" id="year">
          {foreach $years as $y}
            <option value="{$y}" {if $y == $year}selected{/if}>{$y}</option>
          {/foreach}
        </select>
      </div>

      <div class="actions">
        <button style="margin-bottom: 15px" class="btn btn-primary" type="submit">Toon</button>
      </div>
    </div>
  </form>

  <h2>Overzicht voor {$months[$month]} {$year}</h2>

  <section class="kpis">
    <div class="kpi">
      <div class="label">Totaal reserveringen</div>
      <div class="value">{$stats.total_reservations|default:0}</div>
    </div>
    <div class="kpi">
      <div class="label">Totaal personen</div>
      <div class="value">{$stats.total_persons|default:0}</div>
    </div>
    <div class="kpi">
      <div class="label">Totaal omzet</div>
      <div class="value money" style="color: #1b5e20">
        €{$stats.total_revenue|default:0|number_format:2:',':'.'}
      </div>
    </div>
  </section>

  {if $stats.types|@count > 0}
    <h3>Ticketverdeling</h3>
    <div class="table-wrap">
      <table class="table stats-table">
        <thead>
          <tr>
            <th>Type ticket</th>
            <th>Aantal reserveringen</th>
            <th>Totaal personen</th>
            <th>Omzet (€)</th>
          </tr>
        </thead>
        <tbody>
          {foreach $stats.types as $type}
            <tr>
              <td style="font-weight: bold">{$type.ticket_type}</td>
              <td>{$type.count}</td>
              <td>{$type.persons}</td>
              <td style="color: #1b5e20">€{$type.revenue|number_format:2:',':'.'}</td>
            </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  {else}
    <p class="message error">Geen reserveringen gevonden voor deze maand.</p>
  {/if}
</div>
{/block}