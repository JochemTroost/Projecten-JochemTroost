<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:50:03
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbd5cbda7b79_49977595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d03a01694398f2cd93db85668e03ae5b028dfdf' => 
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
function content_68cbd5cbda7b79_49977595 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_116443065868cbd5cbda3ee5_18877171', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_116443065868cbd5cbda3ee5_18877171 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
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
