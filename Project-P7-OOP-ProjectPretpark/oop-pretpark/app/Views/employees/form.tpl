{extends file='layout.tpl'}

{block name="head"}
  <link rel="stylesheet" href="assets/css/employees.css?v=1">
{/block}

{block name="content"}
<div class="container employees-page">
  <h1>{if $action=='store'}Nieuwe medewerker{else}Medewerker bewerken{/if}</h1>

  {if $errors}
    <ul class="flash-err">
      {foreach $errors as $field=>$msg}<li>{$msg|escape}</li>{/foreach}
    </ul>
  {/if}

  <form class="form" method="post" action="index.php?page=employees&amp;a={$action}{if isset($old.id)}&amp;id={$old.id}{/if}">
    <div class="group">
      <div>
        <label for="name">Naam</label>
        <input id="name" name="name" value="{$old.name|default:''|escape}" required>
      </div>

      <div>
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" value="{$old.email|default:''|escape}" required>
      </div>

      <div>
        <label for="role">Rol</label>
        {assign var=rl value=$old.role|default:'medewerker'}
        <select id="role" name="role">
          <option value="medewerker" {if $rl=='medewerker'}selected{/if}>medewerker</option>
          <option value="beheerder" {if $rl=='beheerder'}selected{/if}>beheerder</option>
        </select>
        <div class="hint">Kies de rol voor autorisaties.</div>
      </div>
    </div>

    <div class="employees-toolbar">
      <span class="spacer"></span>
      <button class="btn btn-primary" type="submit">Opslaan</button>
      <a class="btn" href="index.php?e=employees&amp;a=index">Annuleren</a>
    </div>
  </form>
</div>
{/block}