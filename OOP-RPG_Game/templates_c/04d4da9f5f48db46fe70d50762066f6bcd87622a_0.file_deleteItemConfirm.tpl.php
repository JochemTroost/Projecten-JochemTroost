<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:50:32
  from 'file:deleteItemConfirm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbd5e8d449b7_97054953',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04d4da9f5f48db46fe70d50762066f6bcd87622a' => 
    array (
      0 => 'deleteItemConfirm.tpl',
      1 => 1758188747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbd5e8d449b7_97054953 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_207199196868cbd5e8d2d4c6_04307590', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_207199196868cbd5e8d2d4c6_04307590 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-4">
        <div class="alert alert-warning" role="alert">
            ⚠️ Je staat op het punt om het volgende item permanent te verwijderen:
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
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
            </div>
        </div>

        <form action="index.php?page=deleteItemConfirmed" method="POST">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('item')->getId();?>
">
            <button type="submit" class="btn btn-danger">Yes, Delete Item</button>
            <a href="index.php?page=listItems" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php
}
}
/* {/block "content"} */
}
