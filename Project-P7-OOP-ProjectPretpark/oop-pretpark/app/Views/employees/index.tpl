{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/employees.css?v=1">
{/block}

{block name="content"}
<div class="container employees-page">
  <h1>Medewerkers</h1>

  {if $flash_ok}<p class="flash-ok">{$flash_ok|escape}</p>{/if}
  {if $flash_err}<p class="flash-err">{$flash_err|escape}</p>{/if}

  <div class="employees-toolbar">
    <a class="btn btn-primary" href="index.php?page=employees&amp;a=create">+ Nieuwe medewerker</a>
    <span class="spacer"></span>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Naam</th><th>E-mail</th><th>Rol</th><th>Acties</th>
      </tr>
    </thead>
    <tbody>
      {foreach from=$employees item=emp}
        {assign var=role value=$emp->getRole()}
        <tr>
          <td>{$emp->getName()|escape}</td>
          <td>{$emp->getEmail()|escape}</td>
          <td><span class="badge role-{$role|escape}">{$role|escape}</span></td>
          <td class="actions">
            <a class="btn" href="index.php?page=employees&amp;a=edit&amp;id={$emp->getId()}">Bewerken</a>
            <form class="inline" method="post"
                  action="index.php?page=employees&amp;a=delete&amp;id={$emp->getId()}"
                  onsubmit="return confirm('Verwijderen?');">
              <button class="btn btn-danger" type="submit">Verwijderen</button>
            </form>
            <a class="btn" href="index.php?page=roster&amp;a=index&amp;employee_id={$emp->getId()}">Rooster</a>
          </td>
        </tr>
      {/foreach}
      {if not $employees}
        <tr><td colspan="4">Nog geen medewerkers.</td></tr>
      {/if}
    </tbody>
  </table>
</div>
{/block}