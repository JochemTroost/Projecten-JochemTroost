{extends file='layout.tpl'}

{block name="content"}
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Update Item</h3>
            </div>
            <div class="card-body">
                <form action="index.php?page=updateItem" method="POST" id="updateItemForm">
                    <input type="hidden" name="id" value="{$item->getId()}">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$item->getName()}" required>
                    </div>

                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type:</label>
                        <select class="form-select" id="type" name="type" required onchange="updateFormFields()">
                            <option value="weapon" {if $item->getType()=='weapon'}selected{/if}>Weapon</option>
                            <option value="armor" {if $item->getType()=='armor'}selected{/if}>Armor</option>
                            <option value="consumable" {if $item->getType()=='consumable'}selected{/if}>Consumable</option>
                            <option value="misc" {if $item->getType()=='misc'}selected{/if}>Misc</option>
                        </select>
                    </div>

                    <!-- Value -->
                    <div class="mb-3">
                        <label for="value" class="form-label">Value (gold):</label>
                        <input type="number" class="form-control" id="value" name="value" min="0" step="0.01" value="{$item->getValue()}" required>
                    </div>

                    <!-- Conditional Fields -->
                    <div id="attackBonusField" class="mb-3" style="display:none;">
                        <label for="attackBonus" class="form-label">Attack Bonus:</label>
                        <input type="number" class="form-control" id="attackBonus" name="attackBonus" min="0" value="{$item->attackBonus|default:''}">
                    </div>

                    <div id="defenseBonusField" class="mb-3" style="display:none;">
                        <label for="defenseBonus" class="form-label">Defense Bonus:</label>
                        <input type="number" class="form-control" id="defenseBonus" name="defenseBonus" min="0" value="{$item->defenseBonus|default:''}">
                    </div>

                    <div id="healthBonusField" class="mb-3" style="display:none;">
                        <label for="healthBonus" class="form-label">Health Bonus:</label>
                        <input type="number" class="form-control" id="healthBonus" name="healthBonus" min="0" value="{$item->healthBonus|default:''}">
                    </div>

                    <div id="specialEffectField" class="mb-3" style="display:none;">
                        <label for="specialEffect" class="form-label">Special Effect:</label>
                        <input type="text" class="form-control" id="specialEffect" name="specialEffect" value="{$item->specialEffect|default:''}">
                    </div>

                    <div id="miscWarning" class="alert alert-warning" style="display:none;">
                        <strong>Note:</strong> Mystery items (Misc) only allow editing Name, Type, and Value.
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2">Update Item</button>
                        <a href="index.php?page=listItems" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {* JavaScript to toggle fields based on type *}
{literal}
    <script>
        function updateFormFields() {
            const type = document.getElementById('type').value;

            // Hide all conditional fields by default
            document.getElementById('attackBonusField').style.display = 'none';
            document.getElementById('defenseBonusField').style.display = 'none';
            document.getElementById('healthBonusField').style.display = 'none';
            document.getElementById('specialEffectField').style.display = 'none';
            document.getElementById('miscWarning').style.display = 'none';

            if (type === 'weapon' || type === 'armor') {
                document.getElementById('attackBonusField').style.display = 'block';
                document.getElementById('defenseBonusField').style.display = 'block';
            } else if (type === 'consumable') {
                document.getElementById('attackBonusField').style.display = 'block';
                document.getElementById('defenseBonusField').style.display = 'block';
                document.getElementById('healthBonusField').style.display = 'block';
                document.getElementById('specialEffectField').style.display = 'block';
            } else if (type === 'misc') {
                document.getElementById('miscWarning').style.display = 'block';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateFormFields);
    </script>
{/literal}

{/block}
