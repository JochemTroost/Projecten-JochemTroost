<?php
/* Smarty version 5.5.1, created on 2025-06-17 11:49:46
  from 'file:rules.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6851565a2d1540_69469242',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19543296e9d16ac155e5a07865cecd16326624e8' => 
    array (
      0 => 'rules.tpl',
      1 => 1750160972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6851565a2d1540_69469242 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\programming\\school\\oopbasis\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9379024126851565a2cf7e1_42231610', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block "content"} */
class Block_9379024126851565a2cf7e1_42231610 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\programming\\school\\oopbasis\\templates';
?>

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8" />
        <title>Pesten - Spelregels</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
    <div class="start-container">
        <h1>Spelregels – Pesten</h1>

        <ul style="text-align: left;">
            <h2>Wat is dit spel?</h2>
            <li>Dit is de online versie van het bekende kaartspel Pesten. Je speelt het digitaal via je scherm. Het doel is om als eerste al je kaarten kwijt te raken.</li>

            <h2>Hoe werkt het?</h2>
            <li>Elke speler krijgt 7 kaarten te zien op het scherm.</li>
            <li>In het midden ligt een kaart van de stapel. Daar leg je kaarten op die passen bij die kaart: dus met hetzelfde getal of dezelfde soort.</li>
            <li>Je speelt door op een kaart te klikken. Heb je geen geldige kaart? Dan klik je op "Pak kaart" en krijg je er automatisch één bij.</li>

            <h2>Beurten</h2>
            <li>Spelers zijn om de beurt aan zet. Na jouw beurt wacht je tot de ander een zet heeft gedaan.</li>

            <h2>Speciale kaarten:</h2>
            <ul>
                <li><strong>2</strong> – Volgende speler moet 2 kaarten pakken</li>
                <li><strong>7</strong> – Je mag nog een keer</li>
                <li><strong>8</strong> – Volgende speler moet een beurt overslaan</li>
                <li><strong>Boer (J)</strong> – Kies een andere kleur</li>
                <li><strong>Aas (A)</strong> – Richting van het spel draait om</li>
                <li><strong>Heer</strong> – Je mag nog een keer</li>
            </ul>
        </ul>

        <a href="index.php" style="color: white; text-decoration: none;">
            <button class="rules-button">Terug naar startpagina</button>
        </a>
    </div>
    </body>
    </html>
<?php
}
}
/* {/block "content"} */
}
