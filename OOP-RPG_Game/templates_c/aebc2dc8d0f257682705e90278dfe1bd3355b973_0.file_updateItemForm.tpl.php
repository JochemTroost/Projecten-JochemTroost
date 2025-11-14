<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:49:00
  from 'file:updateItemForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbd58c9de435_02646035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aebc2dc8d0f257682705e90278dfe1bd3355b973' => 
    array (
      0 => 'updateItemForm.tpl',
      1 => 1758188332,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbd58c9de435_02646035 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_64197674768cbd58c99fbb9_80467069', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_64197674768cbd58c99fbb9_80467069 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Update Item</h3>
            </div>
            <div class="card-body">
                <form action="index.php?page=updateItem" method="POST" id="updateItemForm">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('item')->getId();?>
">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_smarty_tpl->getValue('item')->getName();?>
" required>
                    </div>

                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type:</label>
                        <select class="form-select" id="type" name="type" required onchange="updateFormFields()">
                            <option value="weapon" <?php if ($_smarty_tpl->getValue('item')->getType() == 'weapon') {?>selected<?php }?>>Weapon</option>
                            <option value="armor" <?php if ($_smarty_tpl->getValue('item')->getType() == 'armor') {?>selected<?php }?>>Armor</option>
                            <option value="consumable" <?php if ($_smarty_tpl->getValue('item')->getType() == 'consumable') {?>selected<?php }?>>Consumable</option>
                            <option value="misc" <?php if ($_smarty_tpl->getValue('item')->getType() == 'misc') {?>selected<?php }?>>Misc</option>
                        </select>
                    </div>

                    <!-- Value -->
                    <div class="mb-3">
                        <label for="value" class="form-label">Value (gold):</label>
                        <input type="number" class="form-control" id="value" name="value" min="0" step="0.01" value="<?php echo $_smarty_tpl->getValue('item')->getValue();?>
" required>
                    </div>

                    <!-- Conditional Fields -->
                    <div id="attackBonusField" class="mb-3" style="display:none;">
                        <label for="attackBonus" class="form-label">Attack Bonus:</label>
                        <input type="number" class="form-control" id="attackBonus" name="attackBonus" min="0" value="<?php echo (($tmp = $_smarty_tpl->getValue('item')->attackBonus ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div id="defenseBonusField" class="mb-3" style="display:none;">
                        <label for="defenseBonus" class="form-label">Defense Bonus:</label>
                        <input type="number" class="form-control" id="defenseBonus" name="defenseBonus" min="0" value="<?php echo (($tmp = $_smarty_tpl->getValue('item')->defenseBonus ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div id="healthBonusField" class="mb-3" style="display:none;">
                        <label for="healthBonus" class="form-label">Health Bonus:</label>
                        <input type="number" class="form-control" id="healthBonus" name="healthBonus" min="0" value="<?php echo (($tmp = $_smarty_tpl->getValue('item')->healthBonus ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div id="specialEffectField" class="mb-3" style="display:none;">
                        <label for="specialEffect" class="form-label">Special Effect:</label>
                        <input type="text" class="form-control" id="specialEffect" name="specialEffect" value="<?php echo (($tmp = $_smarty_tpl->getValue('item')->specialEffect ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
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

    
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>


<?php
}
}
/* {/block "content"} */
}
