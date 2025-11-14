<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:50:36
  from 'file:itemDeleted.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbd5ec4a3b98_57230587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26bf4968b32d6260657b6548d8e1157732c3807e' => 
    array (
      0 => 'itemDeleted.tpl',
      1 => 1758188751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbd5ec4a3b98_57230587 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_88875124568cbd5ec491469_64973468', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_88875124568cbd5ec491469_64973468 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            ✅ Item has been successfully deleted!
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Deleted Item Details
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
            </div>
        </div>

        <a href="index.php?page=listItems" class="btn btn-primary">Back to Item List</a>
        <a href="index.php?page=createItem" class="btn btn-success">Create New Item</a>
    </div>
<?php
}
}
/* {/block "content"} */
}
