<?php
/* Smarty version 5.5.1, created on 2025-06-24 11:10:35
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685a87abb24663_10954049',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1460f935c57cb320fae9297905cb1e160210afee' => 
    array (
      0 => 'home.tpl',
      1 => 1750763429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685a87abb24663_10954049 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\oopbasis\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_67528303685a87abb17437_45086286', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout.tpl', $_smarty_current_dir);
}
/* {block 'content'} */
class Block_67528303685a87abb17437_45086286 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\oopbasis\\templates';
?>

    <div class="container text-center mt-5">
        <h1 class="display-4">Welkom bij onze Webshop!</h1>
        <p class="lead mt-3">Ontdek ons uitgebreide assortiment kwaliteitsproducten tegen scherpe prijzen. Van electronics tot mode, wij hebben alles wat je nodig hebt!</p>

        <hr class="my-4">

        <h3>Waarom bij ons winkelen?</h3>
        <ul class="list-group">
            <li class="list-group-item">✓ Snelle en gratis verzending vanaf €25</li>
            <li class="list-group-item">✓ 30 dagen bedenktijd - niet tevreden, geld terug</li>
            <li class="list-group-item">✓ Uitstekende klantenservice - altijd bereikbaar</li>
            <li class="list-group-item">✓ Veilig betalen met iDEAL, PayPal en creditcard</li>
        </ul>

        <div class="row mt-5">
            <div class="col-md-4">
                <h4>🛍️ Populaire Categorieën</h4>
                <p>Bekijk onze meest populaire productcategorieën</p>
                <a class="btn btn-outline-primary" href="index.php?action=categories" role="button">Alle Categorieën</a>
            </div>
            <div class="col-md-4">
                <h4>🔥 Aanbiedingen</h4>
                <p>Mis onze dagelijkse deals en kortingen niet!</p>
                <a class="btn btn-outline-danger" href="index.php?action=deals" role="button">Bekijk Deals</a>
            </div>
            <div class="col-md-4">
                <h4>⭐ Nieuw</h4>
                <p>Ontdek de nieuwste producten in ons assortiment</p>
                <a class="btn btn-outline-success" href="index.php?action=new" role="button">Nieuwe Producten</a>
            </div>
        </div>

        <p class="mt-5">
            Start nu met winkelen en ontdek onze geweldige producten!
        </p>

        <a class="btn btn-primary btn-lg" href="index.php?page=productList" role="button">Bekijk Alle Producten</a>
        <a class="btn btn-success btn-lg ml-2" href="index.php?action=cart" role="button">🛒 Winkelwagen</a>
    </div>
<?php
}
}
/* {/block 'content'} */
}
