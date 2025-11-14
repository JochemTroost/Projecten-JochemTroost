{extends file="layout.tpl"}

{block name="content"}
    <div class="container mt-4">
        <h2>Character Statistics</h2>
        <p><strong>Total Characters:</strong> {$totalCharacters}</p>

        <!-- Action Buttons -->
        <div class="mb-4">
            <a href="index.php?page=resetStats" class="btn btn-danger me-2">
                <i class="bi bi-x-circle"></i> Reset Statistics
            </a>
            <a href="index.php?page=recalculateStats" class="btn btn-primary">
                <i class="bi bi-arrow-repeat"></i> Recalculate Statistics
            </a>
        </div>

        <!-- Character Types Table -->
        <h4>Character Types</h4>
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
            <tr>
                <th>Type</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$characterTypes key=type item=count}
                <tr>
                    <td>{$type}</td>
                    <td>{$count}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>

        <!-- Character Names List -->
        <h4>Character Names</h4>
        <ul class="list-group shadow-sm">
            {foreach from=$existingNames item=name}
                <li class="list-group-item">{$name}</li>
            {/foreach}
        </ul>
    </div>
{/block}
