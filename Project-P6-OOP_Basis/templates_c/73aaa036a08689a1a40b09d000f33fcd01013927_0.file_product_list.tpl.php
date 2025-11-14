<?php
/* Smarty version 5.5.1, created on 2025-06-30 12:08:39
  from 'file:product_list.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68627e47e78209_27626179',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73aaa036a08689a1a40b09d000f33fcd01013927' => 
    array (
      0 => 'product_list.tpl',
      1 => 1751285301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68627e47e78209_27626179 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\oopbasis\\templates';
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Producten</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto 40px;
            flex-grow: 1;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        li:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 12px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        li h2 {
            margin-top: 0;
            font-size: 1.2em;
            color: #222;
        }

        .labels {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .label {
            font-weight: 700;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 12px;
            color: white;
            text-transform: uppercase;
            user-select: none;
            white-space: nowrap;
        }

        .label.nieuw {
            background-color: #ff6600; /* oranje */
        }

        .label.actie {
            background-color: #0074cc; /* blauw */
        }

        .label.bijna-uitverkocht {
            background-color: #e03e2f; /* rood */
        }

        li p {
            margin: 0.5em 0;
            color: #555;
        }

        /* Vetgedrukte prijs */
        li p.prijs {
            font-weight: bold;
            color: #333;
        }

        a {
            display: inline-block;
            text-decoration: none;
            padding: 8px 12px;
            margin-top: 10px;
            margin-right: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        a:last-of-type {
            background-color: #28a745;
        }

        a:last-of-type:hover {
            background-color: #1e7e34;
        }

        a[href*="cart"] {
            display: inline-block;
            padding: 8px 12px;
            background-color: #ff9800;
            margin-top: 10px;
            margin-right: 10px;
            border-radius: 6px;
            box-sizing: border-box;
            color: #fff;
            text-align: center;
            transition: background-color 0.2s ease;
        }

        a[href*="cart"]:hover {
            background-color: #e68900;
        }

        .footer-buttons {
            max-width: 300px;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .footer-buttons a {
            width: 100%;
            margin: 0;
        }

        .footer-buttons a[href*="cart"] {
            background-color: #ff5722;
        }
        .footer-buttons a[href*="cart"]:hover {
            background-color: #e64a19;
        }

        .footer-buttons a[href*="home"] {
            background-color: #28a745;
        }
        .footer-buttons a[href*="home"]:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>

    <h1>Producten</h1>

    <ul>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
        <li>
            <div class="product-image">
                <img src="data/<?php echo $_smarty_tpl->getValue('product')->getImg();?>
" alt="<?php echo $_smarty_tpl->getValue('product')->getName();?>
">
            </div>

            <h2><?php echo $_smarty_tpl->getValue('product')->getName();?>
</h2>

            <div class="labels">
                <?php if ($_smarty_tpl->getValue('product')->isNew() == "ja") {?>
                  <div class="label nieuw">Nieuw</div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('product')->isActie() == "ja") {?>
                  <div class="label actie">Actie</div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('product')->getStock() == 0) {?>
                  <div class="label bijna-uitverkocht">Uitverkocht!</div>
                <?php } elseif ($_smarty_tpl->getValue('product')->getStock() <= 5) {?>
                  <div class="label bijna-uitverkocht">Bijna uitverkocht!</div>
                <?php }?>
            </div>

            <p class="prijs">Prijs: € <?php echo $_smarty_tpl->getValue('product')->getPrice();?>
</p>
            <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('product')->getDescription(),50,"...");?>
</p>
            <p>Type: <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('product')->getType(),50,"...");?>
</p>

            <a href="index.php?page=product&id=<?php echo $_smarty_tpl->getValue('product')->getId();?>
">Bekijk</a>
            <a href="index.php?action=add_to_cart&product_id=<?php echo $_smarty_tpl->getValue('product')->getId();?>
">In winkelwagen</a>
        </li>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </ul>

    <div class="footer-buttons">
        <a href="index.php?page=cart">Naar winkelwagen</a>
        <a href="index.php?page=home">Terug</a>
    </div>

</body>
</html>
<?php }
}
