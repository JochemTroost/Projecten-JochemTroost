<?php
/* Smarty version 5.4.3, created on 2025-11-10 12:24:32
  from 'file:createItemForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_6911d980e70bc3_76667307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7582736b7f7e3001e3107b51da757a20e4eff3ca' => 
    array (
      0 => 'createItemForm.tpl',
      1 => 1758184131,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6911d980e70bc3_76667307 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3734596606911d980c52e36_46900328', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_3734596606911d980c52e36_46900328 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
?>

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
<?php
}
}
/* {/block "content"} */
}
