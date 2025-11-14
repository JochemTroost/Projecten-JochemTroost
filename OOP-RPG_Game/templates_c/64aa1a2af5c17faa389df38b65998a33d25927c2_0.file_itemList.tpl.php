<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:48:58
  from 'file:itemList.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbd58a6c7233_79262096',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '64aa1a2af5c17faa389df38b65998a33d25927c2' => 
    array (
      0 => 'itemList.tpl',
      1 => 1758188828,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbd58a6c7233_79262096 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_70058104668cbd58a6a9874_61199545', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_70058104668cbd58a6a9874_61199545 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

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
                    <input type="hidden" name="type" id="type" value="<?php echo (($tmp = $_smarty_tpl->getValue('selectedType') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    <input type="hidden" name="minValue" value="<?php echo (($tmp = $_smarty_tpl->getValue('minValue') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    <input type="hidden" name="id" value="<?php echo (($tmp = $_smarty_tpl->getValue('selectedId') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    <input type="hidden" name="name" value="<?php echo (($tmp = $_smarty_tpl->getValue('searchName') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <!-- Type Filter Buttons -->
                    <div class="col-12 mb-3">
                        <h5>Filter by Type:</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary <?php if (!$_smarty_tpl->getValue('selectedType')) {?>active<?php }?>"
                                    onclick="document.getElementById('type').value=''; this.form.submit();">All Items</button>
                            <button type="button" class="btn btn-outline-primary <?php if ($_smarty_tpl->getValue('selectedType') == 'weapon') {?>active<?php }?>"
                                    onclick="document.getElementById('type').value='weapon'; this.form.submit();">Weapons</button>
                            <button type="button" class="btn btn-outline-primary <?php if ($_smarty_tpl->getValue('selectedType') == 'armor') {?>active<?php }?>"
                                    onclick="document.getElementById('type').value='armor'; this.form.submit();">Armor</button>
                            <button type="button" class="btn btn-outline-primary <?php if ($_smarty_tpl->getValue('selectedType') == 'consumable') {?>active<?php }?>"
                                    onclick="document.getElementById('type').value='consumable'; this.form.submit();">Consumables</button>
                            <button type="button" class="btn btn-outline-primary <?php if ($_smarty_tpl->getValue('selectedType') == 'misc') {?>active<?php }?>"
                                    onclick="document.getElementById('type').value='misc'; this.form.submit();">Misc</button>
                        </div>
                    </div>

                    <!-- Other Filters -->
                    <div class="col-md-4">
                        <label for="minValue" class="form-label">Minimum Value:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="minValue" name="minValue" min="0" step="0.01" value="<?php echo (($tmp = $_smarty_tpl->getValue('minValue') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                            <span class="input-group-text">gold</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="id" class="form-label">Item ID:</label>
                        <input type="number" class="form-control" id="id" name="id" min="1" value="<?php echo (($tmp = $_smarty_tpl->getValue('selectedId') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div class="col-md-4">
                        <label for="name" class="form-label">Name Contains:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo (($tmp = $_smarty_tpl->getValue('searchName') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
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
                    <?php if ((true && ($_smarty_tpl->hasVariable('selectedType') && null !== ($_smarty_tpl->getValue('selectedType') ?? null))) || (true && ($_smarty_tpl->hasVariable('minValue') && null !== ($_smarty_tpl->getValue('minValue') ?? null))) || (true && ($_smarty_tpl->hasVariable('selectedId') && null !== ($_smarty_tpl->getValue('selectedId') ?? null))) || (true && ($_smarty_tpl->hasVariable('searchName') && null !== ($_smarty_tpl->getValue('searchName') ?? null)))) {?>
                        Filtered Items
                    <?php } else { ?>
                        All Items
                    <?php }?>
                </h3>
                <div class="mt-2">
                    <small>
                        Filters applied:
                        <?php if ((true && ($_smarty_tpl->hasVariable('selectedType') && null !== ($_smarty_tpl->getValue('selectedType') ?? null)))) {?><span class="badge bg-info">Type: <?php echo $_smarty_tpl->getValue('selectedType');?>
</span><?php }?>
                        <?php if ((true && ($_smarty_tpl->hasVariable('minValue') && null !== ($_smarty_tpl->getValue('minValue') ?? null)))) {?><span class="badge bg-info">Min Value: <?php echo $_smarty_tpl->getValue('minValue');?>
 gold</span><?php }?>
                        <?php if ((true && ($_smarty_tpl->hasVariable('selectedId') && null !== ($_smarty_tpl->getValue('selectedId') ?? null)))) {?><span class="badge bg-info">ID: <?php echo $_smarty_tpl->getValue('selectedId');?>
</span><?php }?>
                        <?php if ((true && ($_smarty_tpl->hasVariable('searchName') && null !== ($_smarty_tpl->getValue('searchName') ?? null)))) {?><span class="badge bg-info">Name: "<?php echo $_smarty_tpl->getValue('searchName');?>
"</span><?php }?>
                    </small>
                </div>
            </div>
            <div class="card-body">
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('items')) > 0) {?>
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
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('items'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getValue('item')->getId();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('item')->getName();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('item')->getType();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('item')->getValue();?>
 gold</td>
                                    <td>
                                        <a href="index.php?page=updateItem&id=<?php echo $_smarty_tpl->getValue('item')->getId();?>
" class="btn btn-sm btn-primary me-1">Edit</a>
                                        <a href="index.php?page=deleteItem&id=<?php echo $_smarty_tpl->getValue('item')->getId();?>
" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3"><strong>Total items displayed:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')((($tmp = $_smarty_tpl->getValue('itemCount') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('items') ?? null : $tmp));?>
</p>
                <?php } else { ?>
                    <div class="alert alert-warning">
                        No items found matching your criteria.
                    </div>
                <?php }?>
            </div>
            <div class="card-footer">
                <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
