{extends file="layout.tpl"}

{block name="content"}
    <div class="container mt-4">

        {if isset($item)}
            <div class="alert alert-success" role="alert">
                Item successfully created!
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Item Details
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {$item->getId()}</p>
                    <p><strong>Name:</strong> {$item->getName()}</p>
                    <p><strong>Type:</strong> {$item->getType()}</p>
                    <p><strong>Value:</strong> {$item->getValue()} gold</p>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="index.php?page=createItem" class="btn btn-primary">Create Another Item</a>
                        <a href="index.php?page=home" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        {else}
            <div class="alert alert-danger" role="alert">
                No item data available.
            </div>
        {/if}

    </div>
{/block}
