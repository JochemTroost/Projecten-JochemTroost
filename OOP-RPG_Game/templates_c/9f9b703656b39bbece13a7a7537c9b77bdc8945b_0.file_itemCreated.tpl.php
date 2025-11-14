<?php
/* Smarty version 5.4.3, created on 2025-09-18 08:34:17
  from 'file:itemCreated.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbc4090047a8_30457119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f9b703656b39bbece13a7a7537c9b77bdc8945b' => 
    array (
      0 => 'itemCreated.tpl',
      1 => 1758184168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbc4090047a8_30457119 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_143312998068cbc408d604b8_63793138', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_143312998068cbc408d604b8_63793138 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-4">

        <?php if ((true && ($_smarty_tpl->hasVariable('item') && null !== ($_smarty_tpl->getValue('item') ?? null)))) {?>
            <div class="alert alert-success" role="alert">
                Item successfully created!
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Item Details
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> <?php echo $_smarty_tpl->getValue('item')->getId();?>
</p>
                    <p><strong>Name:</strong> <?php echo $_smarty_tpl->getValue('item')->getName();?>
</p>
                    <p><strong>Type:</strong> <?php echo $_smarty_tpl->getValue('item')->getType();?>
</p>
                    <p><strong>Value:</strong> <?php echo $_smarty_tpl->getValue('item')->getValue();?>
 gold</p>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="index.php?page=createItem" class="btn btn-primary">Create Another Item</a>
                        <a href="index.php?page=home" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                No item data available.
            </div>
        <?php }?>

    </div>
<?php
}
}
/* {/block "content"} */
}
