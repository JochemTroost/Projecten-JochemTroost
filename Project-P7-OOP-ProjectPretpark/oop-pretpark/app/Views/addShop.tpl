{* app/Views/addShop.tpl *}
{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/shops.css?v=1">
{/block}

{block name="content"}
<h1>Nieuwe shop toevoegen</h1>

<nav>
  <ul>
    <li><a href="index.php">← Terug naar dashboard</a></li>
    <li><a href="index.php?page=shopList">Overzicht shops</a></li>
  </ul>
</nav>

{if $message}<p class="message success">{$message|escape}</p>{/if}
{if $error}<p class="message error">{$error|escape}</p>{/if}

<form class="form shop-form" method="post" action="index.php?page=addShop">

  <fieldset class="shop-block">
    <legend>Basisgegevens</legend>

    <div class="group">
      <div>
        <label for="name">Naam</label>
        <input id="name" type="text" name="name" required
               value="{$smarty.post.name|default:''|escape}">
      </div>

      <div>
        <label for="type_code">Type</label>
        <select id="type_code" name="type_code" required>
          <option value="">— Selecteer type —</option>
          {foreach from=$shopTypes key=code item=typeNameOption}
            <option value="{$code}"
              {if ($smarty.post.type_code|default:'') == $code}selected{/if}>
              {$code} - {$typeNameOption|escape}
            </option>
          {/foreach}
        </select>
      </div>

      <div>
        <label for="location">Locatie</label>
        <select id="location" name="location">
          <option value="">— Selecteer locatie —</option>
          {foreach from=$shopLocations key=code item=locName}
            <option value="{$locName|escape}"
              {if ($smarty.post.location|default:'') == $locName}selected{/if}>
              {$code} - {$locName|escape}
            </option>
          {/foreach}
        </select>
      </div>

      <div>
        <label for="rating">Rating</label>
        <select id="rating" name="rating">
          <option value="0">— Selecteer rating —</option>
          {section name=i loop=6 start=1}
            <option value="{$smarty.section.i.index}"
              {if ($smarty.post.rating|default:0) == $smarty.section.i.index}selected{/if}>
              {$smarty.section.i.index} ⭐
            </option>
          {/section}
        </select>
      </div>
    </div>

    <p class="help">Deze gegevens bepalen hoe de shop in het overzicht verschijnt.</p>
  </fieldset>

  <fieldset class="shop-block">
    <legend>Capaciteit &amp; betalen</legend>

    <div class="group">
      <div>
        <label for="capacity">Capaciteit</label>
        <input id="capacity" type="number" name="capacity" min="0"
               value="{$smarty.post.capacity|default:0}">
      </div>

      <div>
        <label>Betaalopties</label>
        {assign var="options" value=["pin","contant","bankoverschrijving"]}
        <div>
          {foreach from=$options item=opt}
            <label>
              <input type="checkbox" name="payment_options[]" value="{$opt}"
                {if isset($smarty.post.payment_options) && in_array($opt, $smarty.post.payment_options)}checked{/if}>
              {$opt|capitalize}
            </label><br>
          {/foreach}
        </div>
      </div>
    </div>
  </fieldset>

  <fieldset class="shop-block">
    <legend>Financieel</legend>

    <div class="financial-block">
      <div class="tile">
        <label for="product_price">Productprijs (€)</label>
        <input id="product_price" type="number" step="0.01" min="0" name="product_price"
               value="{$smarty.post.product_price|default:0}">
      </div>

      <div class="tile">
        <label for="products_sold">Verkochte producten</label>
        <input id="products_sold" type="number" min="0" name="products_sold"
               value="{$smarty.post.products_sold|default:0}">
      </div>
    </div>

    <p class="help">Omzet = <em>productprijs × aantal verkocht</em> (wordt server-side berekend).</p>
  </fieldset>

  <fieldset class="shop-block">
    <legend>Openingstijden</legend>

    <table class="opening-table">
      <thead>
        <tr><th>Dag</th><th>Open</th><th>Sluit</th></tr>
      </thead>
      <tbody>
        {assign var="days" value=["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]}
        {foreach from=$days item=day}
          <tr>
            <td>{$day|capitalize}</td>
            <td>
              <input type="time" name="opening_times[{$day}][open]"
                     value="{$smarty.post.opening_times[$day].open|default:''}">
            </td>
            <td>
              <input type="time" name="opening_times[{$day}][close]"
                     value="{$smarty.post.opening_times[$day].close|default:''}">
            </td>
          </tr>
        {/foreach}
      </tbody>
    </table>
  </fieldset>

  <div class="form-actions">
    <button class="btn btn-primary" type="submit">Shop toevoegen</button>
    <a class="btn" href="index.php?page=shopList">Annuleren</a>
  </div>
</form>
{/block}