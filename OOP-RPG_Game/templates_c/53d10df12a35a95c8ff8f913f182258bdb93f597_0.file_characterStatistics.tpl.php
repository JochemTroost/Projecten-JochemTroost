<?php
/* Smarty version 5.4.3, created on 2025-09-17 18:30:00
  from 'file:characterStatistics.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cafe2899d143_14214913',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53d10df12a35a95c8ff8f913f182258bdb93f597' => 
    array (
      0 => 'characterStatistics.tpl',
      1 => 1758133388,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cafe2899d143_14214913 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_49942435468cafe28994a37_84078651', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_49942435468cafe28994a37_84078651 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?>

    <div class="container mt-4">
        <h2>Character Statistics</h2>
        <p><strong>Total Characters:</strong> <?php echo $_smarty_tpl->getValue('totalCharacters');?>
</p>

        <!-- Action Buttons -->
        <div class="mb-4">
            <a href="index.php?page=resetStats" class="btn btn-danger me-2">
                <i class="bi bi-x-circle"></i> Reset Statistics
            </a>
            <a href="index.php?page=recalculateStats" class="btn btn-primary">
                <i class="bi bi-arrow-repeat"></i> Recalculate Statistics
            </a>
        </div>

        <!-- Character Types Table -->
        <h4>Character Types</h4>
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
            <tr>
                <th>Type</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('characterTypes'), 'count', false, 'type');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('type')->value => $_smarty_tpl->getVariable('count')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('type');?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('count');?>
</td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>

        <!-- Character Names List -->
        <h4>Character Names</h4>
        <ul class="list-group shadow-sm">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('existingNames'), 'name');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('name')->value) {
$foreach1DoElse = false;
?>
                <li class="list-group-item"><?php echo $_smarty_tpl->getValue('name');?>
</li>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php
}
}
/* {/block "content"} */
}
