{extends file='layout.tpl'}

{block name="content"}
    <div class="container mt-4">
        <div class="alert alert-warning" role="alert">
            ⚠️ Je staat op het punt om het volgende item permanent te verwijderen:
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                Item Details
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {$item->getId()}</p>
                <p><strong>Name:</strong> {$item->getName()}</p>
                <p><strong>Type:</strong> {$item->getType()}</p>
                <p><strong>Value:</strong> {$item->getValue()} gold</p>
            </div>
        </div>

        <form action="index.php?page=deleteItemConfirmed" method="POST">
            <input type="hidden" name="id" value="{$item->getId()}">
            <button type="submit" class="btn btn-danger">Yes, Delete Item</button>
            <a href="index.php?page=listItems" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
{/block}
