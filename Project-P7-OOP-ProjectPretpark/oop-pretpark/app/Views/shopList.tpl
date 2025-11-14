{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/shops.css">
{/block}

{block name="content"}
  <h1>Shop overzicht</h1>

  {if $message}
      <p class="message success">{$message|escape}</p>
  {/if}

  {if $error}
      <p class="message error">{$error|escape}</p>
  {/if}

  <table class="shop-list-table">
      <tr>
          <th>ID</th>
          <th>Naam</th>
          <th>Type</th>
          <th>Locatie</th>
          <th>Rating</th>
          <th>Acties</th>
      </tr>

      {foreach from=$shops item=shop}
          <tr>
              <td>{$shop->getId()}</td>
              <td>{$shop->getName()|escape}</td>
              <td>{$shop->getTypeName()|escape}</td>
              <td>{if $shop->getLocation()}{$shop->getLocation()|escape}{else}-{/if}</td>
              <td>
                  {assign var="rating" value=$shop->getRating()}
                  {section name=i loop=$rating}⭐{/section}
              </td>
              <td>
                  <a href="index.php?page=viewShop&amp;id={$shop->getId()}">Bekijken</a> |
                  <a href="index.php?page=editShop&amp;id={$shop->getId()}">Bewerken</a>
              </td>
          </tr>
      {/foreach}
  </table>

  <a href="index.php?page=addShop" class="add-shop-link">Nieuwe Shop toevoegen</a>
{/block}