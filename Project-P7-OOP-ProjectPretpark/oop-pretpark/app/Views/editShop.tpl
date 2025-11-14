{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/shops.css">
{/block}

{block name="content"}
<h1>Shop Bewerken: {$shop->getName()|escape}</h1>
<nav><a href="index.php?page=shopList">← Terug naar Overzicht</a></nav>

{if $message}
    <p class="message success">{$message|escape}</p>
{/if}
{if $error}
    <p class="message error">{$error|escape}</p>
{/if}

<form method="post" action="index.php?page=editShop&amp;id={$shop->getId()}">

    <!-- Algemene Informatie -->
    <fieldset class="shop-block">
        <legend>Algemene Informatie</legend>

        <label>Naam:</label>
        <input type="text" name="name" required value="{$shop->getName()|escape}"><br><br>

        <label>Type:</label>
        <select name="type_code" required>
            {foreach from=$shopTypes key=code item=typeNameOption}
                <option value="{$code}" {if $shop->getTypeCode() == $code}selected{/if}>
                    {$code} - {$typeNameOption|escape}
                </option>
            {/foreach}
        </select><br><br>

        <label>Locatie:</label>
        <select name="location">
            {foreach from=$shopLocations key=code item=locName}
                <option value="{$locName|escape}" {if $shop->getLocation() == $locName}selected{/if}>
                    {$code} - {$locName|escape}
                </option>
            {/foreach}
        </select><br><br>

        <label>Rating:</label>
        <select name="rating">
            {section name=i loop=6 start=1}
                <option value="{$smarty.section.i.index}" {if $shop->getRating() == $smarty.section.i.index}selected{/if}>
                    {$smarty.section.i.index} ⭐
                </option>
            {/section}
        </select><br><br>

        <label>Capacity:</label>
        <input type="number" name="capacity" value="{$shop->getCapacity()}"><br><br>
    </fieldset>

    <!-- Financieel -->
    <fieldset class="shop-block">
        <legend>Financieel</legend>

        <label>Productprijs (€):</label>
        <input type="number" step="0.01" name="product_price" value="{$shop->getProductPrice()}"><br><br>

        <label>Verkochte producten:</label>
        <input type="number" name="products_sold" value="{$shop->getProductsSold()}"><br><br>

        <label>Omzet (€):</label>
        <input type="number" step="0.01" name="revenue" value="{$shop->getRevenue()}" readonly><br><br>

        <label>Kosten (€):</label>
        {assign var="expenses" value=$shop->getRevenue() * 0.7} {* 30% winst betekent 70% kosten *}
        <input type="number" step="0.01" name="expenses" value="{$expenses}" readonly><br><br>

        <label>Winstmarge (%):</label>
        {assign var="profit" value=$shop->getRevenue() > 0 ? (($shop->getRevenue() - $expenses)/$shop->getRevenue()*100) : 0}
        <input type="number" step="0.01" name="profit_margin" value="{$profit}" readonly><br><br>

        <label>Betalings mogelijkheden:</label><br>
        {assign var="options" value=["pin","contant","bankoverschrijving"]}
        {assign var="paymentOptionsArray" value=[]}
        {if $shop->getPaymentOptions() neq ''}
            {assign var="paymentOptionsArray" value=$shop->getPaymentOptions()|split:","}
        {/if}
        {foreach from=$options item=opt}
            <input type="checkbox" name="payment_options[]" value="{$opt}" {if in_array($opt, $paymentOptionsArray)}checked{/if}>
            <label>{$opt|capitalize}</label><br>
        {/foreach}
    </fieldset>

    <!-- Openingstijden -->
    <fieldset class="shop-block">
        <legend>Openingstijden</legend>
        <table border="1" cellpadding="5">
            <tr>
                <th>Dag</th>
                <th>Open</th>
                <th>Close</th>
            </tr>
            {assign var="days" value=["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]}
            {foreach from=$days item=day}
                <tr>
                    <td>{$day|capitalize}</td>
                    <td><input type="time" name="opening_times[{$day}][open]" value="{$openingTimes[$day].open|default:''}"></td>
                    <td><input type="time" name="opening_times[{$day}][close]" value="{$openingTimes[$day].close|default:''}"></td>
                </tr>
            {/foreach}
        </table>
    </fieldset>

    <button type="submit">Opslaan</button>
    <button type="submit" name="delete" onclick="return confirm('Weet je zeker dat je deze shop wilt verwijderen?');">Verwijderen</button>
</form>
{/block}