{extends file="layout.tpl"}

{block name="content"}
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Create Item
            </div>
            <div class="card-body">
                <form action="index.php?page=saveItem" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Item Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="" disabled selected>-- Select Type --</option>
                            <option value="weapon">Weapon</option>
                            <option value="armor">Armor</option>
                            <option value="consumable">Consumable</option>
                            <option value="misc">Misc</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Item Value</label>
                        <input type="number" class="form-control" id="value" name="value" step="0.01" min="0" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?page=home" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Create Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}
