<?php
/* Smarty version 5.4.3, created on 2025-09-18 10:11:02
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbdab6b63024_85909988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6167068863f92081473bf5bac91f97db7b1a49a4' => 
    array (
      0 => 'error.tpl',
      1 => 1758188999,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbdab6b63024_85909988 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_194208105268cbdab6b53049_98980200', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_194208105268cbdab6b53049_98980200 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
?>

    <div class="container mt-4">
        <div class="alert alert-danger" role="alert">
            <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                <?php echo $_smarty_tpl->getValue('error');?>

            <?php } else { ?>
                Er is een onbekende fout opgetreden.
            <?php }?>
        </div>
        <a href="index.php?page=listItems" class="btn btn-primary">Terug naar Item List</a>
        <a href="index.php" class="btn btn-secondary">Home</a>
    </div>
<?php
}
}
/* {/block "content"} */
}
