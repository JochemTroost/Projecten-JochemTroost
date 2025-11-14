<?php
/* Smarty version 5.4.3, created on 2025-09-18 08:23:58
  from 'file:testDatabase.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbc19ec866e3_94301716',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f9fd06a37d196e9b11dd3e047fbad36ab86df41' => 
    array (
      0 => 'testDatabase.tpl',
      1 => 1758183755,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbc19ec866e3_94301716 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_33044086768cbc19ec7fcb1_13701809', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_33044086768cbc19ec7fcb1_13701809 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-5">
        <div class="card border-<?php echo $_smarty_tpl->getValue('status');?>
 text-<?php echo $_smarty_tpl->getValue('status');?>
">
            <div class="card-body">
                <h5 class="card-title">Database Test Resultaat</h5>
                <p class="card-text"><?php echo $_smarty_tpl->getValue('message');?>
</p>
                <a href="index.php?page=home" class="btn btn-primary">Terug naar Home</a>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
