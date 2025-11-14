{extends file='layout.tpl'}

{block name="content"}
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            ✅ Item has been successfully deleted!
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Deleted Item Details
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {$item->getId()}</p>
                <p><strong>Name:</strong> {$item->getName()}</p>
                <p><strong>Type:</strong> {$item->getType()}</p>
                <p><strong>Value:</strong> {$item->getValue()} gold</p>
            </div>
        </div>

        <a href="index.php?page=listItems" class="btn btn-primary">Back to Item List</a>
        <a href="index.php?page=createItem" class="btn btn-success">Create New Item</a>
    </div>
{/block}
