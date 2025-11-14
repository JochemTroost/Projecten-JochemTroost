{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/shops.css">
{/block}

{block name="content"}
<div class="container">
  {if $shop}
    <h1>Shop: {$shop->getName()|escape}</h1>

    <!-- Algemene info -->
    <div class="section general-info">
      <h2>Algemene info</h2>
      <p><strong>Type:</strong> {$shop->getTypeName()|escape}</p>
      <p><strong>Locatie:</strong> {if $shop->getLocation()}{$shop->getLocation()|escape}{else}-{/if}</p>
      <p><strong>Rating:</strong>
        <span class="rating-stars">
          {assign var="rating" value=$shop->getRating()}
          {section name=i loop=$rating}⭐{/section}
        </span>
      </p>
      <p><strong>Customers per day:</strong> {$shop->getSize()}</p>
      <p><strong>Capacity:</strong> {$shop->getCapacity()}</p>
    </div>

    <!-- Financieel -->
    <div class="section financial-info">
      <h2>Financieel</h2>
      <p><strong>Productprijs:</strong> €{$shop->getProductPrice()}</p>
      <p><strong>Verkochte producten:</strong> {$shop->getProductsSold()}</p>
      <p><strong>Omzet:</strong> €{$shop->getRevenue()}</p>
      <p><strong>Kosten:</strong> €{$shop->getExpenses()}</p>
      <p><strong>Winstmarge:</strong> {$shop->getProfitMargin()}%</p>
    </div>

    <!-- Openingstijden -->
    <div class="section opening-times">
      <h2>Openingstijden</h2>
      <table>
        <tr>
          <th>Dag</th>
          <th>Open</th>
          <th>Close</th>
        </tr>
        {foreach from=$shop->getOpeningTimes() key=day item=times}
          <tr>
            <td>{$day|capitalize}</td>
            <td>{if $times.open}{$times.open}{else}-{/if}</td>
            <td>{if $times.close}{$times.close}{else}-{/if}</td>
          </tr>
        {/foreach}
      </table>
    </div>

    <!-- Betalingsopties -->
    <div class="section payment-info">
      <h2>Payment Options</h2>
      <p>{if $shop->getPaymentOptions()}{$shop->getPaymentOptions()|escape}{else}-{/if}</p>
    </div>

    <!-- Navigatie -->
    <nav>
      <a href="index.php?page=shopList">← Terug naar Overzicht</a> |
      <a href="index.php?page=editShop&amp;id={$shop->getId()}">Bewerken</a>
    </nav>

  {else}
    <p>Shop niet gevonden.</p>
    <a href="index.php?page=shopList">← Terug naar Overzicht</a>
  {/if}
</div>
{/block}