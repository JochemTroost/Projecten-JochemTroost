{extends file='layout.tpl'}

{block name="content"}
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Item List</h2>
            <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
        </div>

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h3>Filter Items</h3>
            </div>
            <div class="card-body">
                <form action="index.php" method="GET" class="row g-3">
                    <input type="hidden" name="page" value="listItems">
                    <input type="hidden" name="type" id="type" value="{$selectedType|default:''}">
                    <input type="hidden" name="minValue" value="{$minValue|default:''}">
                    <input type="hidden" name="id" value="{$selectedId|default:''}">
                    <input type="hidden" name="name" value="{$searchName|default:''}">

                    <!-- Type Filter Buttons -->
                    <div class="col-12 mb-3">
                        <h5>Filter by Type:</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary {if !$selectedType}active{/if}"
                                    onclick="document.getElementById('type').value=''; this.form.submit();">All Items</button>
                            <button type="button" class="btn btn-outline-primary {if $selectedType=='weapon'}active{/if}"
                                    onclick="document.getElementById('type').value='weapon'; this.form.submit();">Weapons</button>
                            <button type="button" class="btn btn-outline-primary {if $selectedType=='armor'}active{/if}"
                                    onclick="document.getElementById('type').value='armor'; this.form.submit();">Armor</button>
                            <button type="button" class="btn btn-outline-primary {if $selectedType=='consumable'}active{/if}"
                                    onclick="document.getElementById('type').value='consumable'; this.form.submit();">Consumables</button>
                            <button type="button" class="btn btn-outline-primary {if $selectedType=='misc'}active{/if}"
                                    onclick="document.getElementById('type').value='misc'; this.form.submit();">Misc</button>
                        </div>
                    </div>

                    <!-- Other Filters -->
                    <div class="col-md-4">
                        <label for="minValue" class="form-label">Minimum Value:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="minValue" name="minValue" min="0" step="0.01" value="{$minValue|default:''}">
                            <span class="input-group-text">gold</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="id" class="form-label">Item ID:</label>
                        <input type="number" class="form-control" id="id" name="id" min="1" value="{$selectedId|default:''}">
                    </div>

                    <div class="col-md-4">
                        <label for="name" class="form-label">Name Contains:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$searchName|default:''}">
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                        <a href="index.php?page=listItems" class="btn btn-secondary">Clear All Filters</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Items Table -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>
                    {if isset($selectedType) || isset($minValue) || isset($selectedId) || isset($searchName)}
                        Filtered Items
                    {else}
                        All Items
                    {/if}
                </h3>
                <div class="mt-2">
                    <small>
                        Filters applied:
                        {if isset($selectedType)}<span class="badge bg-info">Type: {$selectedType}</span>{/if}
                        {if isset($minValue)}<span class="badge bg-info">Min Value: {$minValue} gold</span>{/if}
                        {if isset($selectedId)}<span class="badge bg-info">ID: {$selectedId}</span>{/if}
                        {if isset($searchName)}<span class="badge bg-info">Name: "{$searchName}"</span>{/if}
                    </small>
                </div>
            </div>
            <div class="card-body">
                {if $items|@count > 0}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$items item=item}
                                <tr>
                                    <td>{$item->getId()}</td>
                                    <td>{$item->getName()}</td>
                                    <td>{$item->getType()}</td>
                                    <td>{$item->getValue()} gold</td>
                                    <td>
                                        <a href="index.php?page=updateItem&id={$item->getId()}" class="btn btn-sm btn-primary me-1">Edit</a>
                                        <a href="index.php?page=deleteItem&id={$item->getId()}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3"><strong>Total items displayed:</strong> {$itemCount|default:$items|@count}</p>
                {else}
                    <div class="alert alert-warning">
                        No items found matching your criteria.
                    </div>
                {/if}
            </div>
            <div class="card-footer">
                <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>

    </div>
{/block}
