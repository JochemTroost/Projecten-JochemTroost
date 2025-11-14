{extends file="layout.tpl"}

{block name=content}
    <div class="container mt-5">
        <div class="card border-{$status} text-{$status}">
            <div class="card-body">
                <h5 class="card-title">Database Test Resultaat</h5>
                <p class="card-text">{$message}</p>
                <a href="index.php?page=home" class="btn btn-primary">Terug naar Home</a>
            </div>
        </div>
    </div>
{/block}
