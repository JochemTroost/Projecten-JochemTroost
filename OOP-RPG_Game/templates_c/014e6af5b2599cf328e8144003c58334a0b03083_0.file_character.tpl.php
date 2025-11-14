<?php
/* Smarty version 5.4.3, created on 2025-09-17 17:57:14
  from 'file:character.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68caf67ad24493_54357522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '014e6af5b2599cf328e8144003c58334a0b03083' => 
    array (
      0 => 'character.tpl',
      1 => 1758131829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.tpl' => 1,
  ),
))) {
function content_68caf67ad24493_54357522 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
?><br>
<br>
<br>
<br>
<div style="text-align: center">
<h2>Character Details</h2>

<p><strong>Naam:</strong> <?php echo $_smarty_tpl->getValue('character')->getName();?>
</p>
<p><strong>Rol:</strong> <?php echo $_smarty_tpl->getValue('character')->getRole();?>
</p>
<p><strong>Health:</strong> <?php echo $_smarty_tpl->getValue('character')->getHealth();?>
</p>
<p><strong>Aanval:</strong> <?php echo $_smarty_tpl->getValue('character')->getAttack();?>
</p>
<p><strong>Verdediging:</strong> <?php echo $_smarty_tpl->getValue('character')->getDefence();?>
</p>
<p><strong>Range:</strong> <?php echo $_smarty_tpl->getValue('character')->getRange();?>
</p>

<?php if ($_smarty_tpl->getValue('character')->getRole() == "Warrior") {?>
    <p><strong>Rage:</strong> <?php echo $_smarty_tpl->getValue('character')->getRage();?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getValue('character')->getRole() == "Mage") {?>
    <p><strong>Mana:</strong> <?php echo $_smarty_tpl->getValue('character')->getMana();?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getValue('character')->getRole() == "Rogue") {?>
    <p><strong>Energy:</strong> <?php echo $_smarty_tpl->getValue('character')->getEnergy();?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getValue('character')->getRole() == "Healer") {?>
    <p><strong>Spirit:</strong> <?php echo $_smarty_tpl->getValue('character')->getSpirit();?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getValue('character')->getRole() == "Tank") {?>
    <p><strong>Shield:</strong> <?php echo $_smarty_tpl->getValue('character')->getShield();?>
</p>
<?php }?>

<p><a href="index.php?page=characterList">Terug naar Character List</a></p>
</div>
<?php $_smarty_tpl->renderSubTemplate('file:layout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
