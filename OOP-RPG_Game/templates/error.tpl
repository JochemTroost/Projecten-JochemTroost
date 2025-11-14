{extends file='layout.tpl'}

{block name="content"}
    <div class="container mt-4">
        <div class="alert alert-danger" role="alert">
            {if isset($error)}
                {$error}
            {else}
                Er is een onbekende fout opgetreden.
            {/if}
        </div>
        <a href="index.php?page=listItems" class="btn btn-primary">Terug naar Item List</a>
        <a href="index.php" class="btn btn-secondary">Home</a>
    </div>
{/block}
