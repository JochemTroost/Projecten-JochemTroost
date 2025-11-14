<?php
/* Smarty version 5.5.2, created on 2025-10-02 07:05:48
  from 'file:shopList.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68de244c5cacd5_72356778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9fdc84423fb920f47e56664a7d95bbcb52f95bbb' => 
    array (
      0 => 'shopList.tpl',
      1 => 1759388567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68de244c5cacd5_72356778 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\oop-pretpark\\app\\views';
?><!DOCTYPE html>
<html>
<head>
    <title>Shop overzicht</title>
</head>
<body>
<h1>Shop overzicht</h1>

<?php if ($_smarty_tpl->getValue('message')) {?>
    <p style="color:green"><?php echo $_smarty_tpl->getValue('message');?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getValue('error')) {?>
    <p style="color:red"><?php echo $_smarty_tpl->getValue('error');?>
</p>
<?php }?>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Type</th>
        <th>Locatie</th>
        <th>Rating</th>
        <th>Acties</th>
    </tr>

    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('shops'), 'shop');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('shop')->value) {
$foreach0DoElse = false;
?>
        <tr>
            <td><?php echo $_smarty_tpl->getValue('shop')->getId();?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('shop')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('shop')->getTypeName(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('shop')->getLocation(), ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td><?php
$__section_star_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('shop')->getRating()) ? count($_loop) : max(0, (int) $_loop));
$__section_star_0_total = $__section_star_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_star'] = new \Smarty\Variable(array());
if ($__section_star_0_total !== 0) {
for ($__section_star_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] = 0; $__section_star_0_iteration <= $__section_star_0_total; $__section_star_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']++){
?>⭐<?php
}
}
?></td>
            <td>
                <a href="index.php?action=viewShop&id=<?php echo $_smarty_tpl->getValue('shop')->getId();?>
">Bekijken</a>
            </td>
        </tr>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</table>

<br>
<a href="index.php?action=addShop">Nieuwe Shop toevoegen</a>

</body>
</html>
<?php }
}
