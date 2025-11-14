<?php
/* Smarty version 5.5.1, created on 2025-06-17 11:49:39
  from 'file:name.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68515653c74ef1_99672089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5769d420261cd52a465a5eee9f8e7bc4a2619daa' => 
    array (
      0 => 'name.tpl',
      1 => 1750160972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68515653c74ef1_99672089 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\programming\\school\\oopbasis\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3681179068515653c72ae1_72770829', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_3681179068515653c72ae1_72770829 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\programming\\school\\oopbasis\\templates';
?>

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8" />
        <title>Pesten - Spel</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
    <div class="start-container">
        <h2>Voer je naam in</h2>
        <form method="post" action="index.php">
            <input type="hidden" name="action" value="game" />
            <input type="text" name="player_name" placeholder="Jouw naam" required />
            <button type="submit" class="start-button">Beginnen</button>
        </form>
    </div>
    </body>
    </html>
<?php
}
}
/* {/block "content"} */
}
