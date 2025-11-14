<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:16:37
  from 'file:characterList.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbcdf5571db2_38492439',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '477cafe4352edabdfa6c635dd3143f96b3a6aa59' => 
    array (
      0 => 'characterList.tpl',
      1 => 1758186996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbcdf5571db2_38492439 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_152357663768cbcdf5563f75_47742895', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block 'content'} */
class Block_152357663768cbcdf5563f75_47742895 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container my-5">
        <h2>Character List</h2>

        <a href="index.php?page=createCharacter" class="btn btn-primary mb-3">Create New Character</a>

        <table class="table table-striped table-bordered bg-light">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Health</th>
                <th>Attack</th>
                <th>Defence</th>
                <th>Range</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('characterList'), 'character');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('character')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('character')->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('character')->getRole();?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('character')->getHealth();?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('character')->getAttack();?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('character')->getDefence();?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('character')->getRange();?>
</td>
                    <td>
                        <a href="index.php?page=viewCharacter&name=<?php echo $_smarty_tpl->getValue('character')->getName();?>
" class="btn btn-sm btn-info">View</a>
                        <a href="index.php?page=deleteCharacter&name=<?php echo $_smarty_tpl->getValue('character')->getName();?>
" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>

        <p><strong>Total Characters:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('characterList'));?>
</p>
    </div>
<?php
}
}
/* {/block 'content'} */
}
