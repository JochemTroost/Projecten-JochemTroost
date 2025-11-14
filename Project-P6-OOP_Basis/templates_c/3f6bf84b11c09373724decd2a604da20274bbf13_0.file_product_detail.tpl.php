<?php
/* Smarty version 5.5.1, created on 2025-06-30 11:40:04
  from 'file:product_detail.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68627794c5fa06_51277041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f6bf84b11c09373724decd2a604da20274bbf13' => 
    array (
      0 => 'product_detail.tpl',
      1 => 1751283602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68627794c5fa06_51277041 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\oopbasis\\templates';
?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <title><?php if ($_smarty_tpl->getValue('product')) {
echo $_smarty_tpl->getValue('product')->getName();
} else { ?>Product niet gevonden<?php }?></title>

</head>
<head>
  <meta charset="UTF-8" />
  <title><?php if ($_smarty_tpl->getValue('product')) {
echo $_smarty_tpl->getValue('product')->getName();
} else { ?>Product niet gevonden<?php }?></title>
  <style>
    /* Reset en basis */
    * {
      box-sizing: border-box;
    }
    body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* minimaal hele schermhoogte */
  background-color: #f6f9fc;
  color: #1c1c1c;
  margin: 0;
     font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 20px;
  flex-direction: column; /* zodat header + content onder elkaar komen */
}

.main-content {
  display: flex;
  gap: 40px;
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
  max-width: 900px;
  width: 100%;
  margin-bottom: 30px;
}




    a {
      color: #0074cc;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    a:hover {
      color: #005499;
      text-decoration: underline;
    }

    /* Top banner labels */
    .top-banner {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    .label {
      font-weight: 700;
      font-size: 0.9rem;
      padding: 5px 12px;
      border-radius: 15px;
      color: white;
      text-transform: uppercase;
      user-select: none;
    }
    .label.nieuw {
      background-color: #ff6600; /* oranje */
    }
    .label.actie {
      background-color: #0074cc; /* blauw */
    }
    .label.bijna-uitverkocht {
     background-color: #e03e2f; /* mooi rood, net als actie/nieuw */
     color: white;
    }


    /* Main container */
    .main-content {
      display: flex;
      gap: 40px;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
      max-width: 900px;
      margin-bottom: 30px;
    }

    /* Product image */
    .product-image img {
      max-width: 350px;
      width: 100%;
      border-radius: 8px;
      object-fit: contain;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
    }

    /* Product details */
    .product-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .product-details h1 {
      font-weight: 700;
      font-size: 2rem;
      margin-top: 0;
      margin-bottom: 10px;
      color: #0074cc;
    }

    .price {
      font-size: 1.8rem;
      font-weight: 700;
      color: #ff6600;
      margin: 10px 0 20px;
    }

    .product-details p {
      font-size: 1rem;
      margin: 5px 0;
      line-height: 1.4;
      color: #333;
    }

    /* Knoppen */
    button {
      background-color: #0074cc;
      border: none;
      color: white;
      font-weight: 700;
      padding: 15px 25px;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 15px;
      align-self: start;
      box-shadow: 0 4px 8px rgb(0 116 204 / 0.3);
    }
    button:hover:not(:disabled) {
      background-color: #005499;
    }
    button:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
      box-shadow: none;
      color: #666666;
    }

    /* Terug link */
    .back-link {
      display: inline-block;
      font-weight: 600;
      margin-top: 10px;
      font-size: 1rem;
      color: #0074cc;
      user-select: none;
    }
    .back-link:hover {
      text-decoration: underline;
      color: #005499;
    }

    /* Responsive */
    @media (max-width: 700px) {
      .main-content {
        flex-direction: column;
        max-width: 100%;
      }
      .product-image img {
        max-width: 100%;
        margin: 0 auto;
      }
      .product-details {
        margin-top: 20px;
      }
      button {
        width: 100%;
        text-align: center;
      }
     

    }

  </style>
</head>

<body>

<?php if ($_smarty_tpl->getValue('product')) {?>
  <div class="top-banner">
    <?php if ($_smarty_tpl->getValue('product')->isNew() == "ja") {?>
      <div class="label nieuw">Nieuw</div>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('product')->isActie() == "ja") {?>
      <div class="label actie">Actie</div>
    <?php }?>
     <?php if ($_smarty_tpl->getValue('product')->getStock() == 0) {?>
        <div class="label bijna-uitverkocht"">Uitverkocht</div>
    <?php } elseif ($_smarty_tpl->getValue('product')->getStock() <= 5) {?>
        <div class="label bijna-uitverkocht"">Bijna Uitverkocht</div>
    <?php }?>
   
  </div>

  <div class="main-content">
    <div class="product-image">
      <img src="data/<?php echo $_smarty_tpl->getValue('product')->getImg();?>
" alt="<?php echo $_smarty_tpl->getValue('product')->getName();?>
">
    </div>
    <div class="product-details">
      <h1><?php echo $_smarty_tpl->getValue('product')->getName();?>
</h1>
      <p class="price">€ <?php echo $_smarty_tpl->getValue('product')->getPrice();?>
</p>
      <p>Beschrijving: <?php echo $_smarty_tpl->getValue('product')->getDescription();?>
</p>
      <p>Voorraad: <?php echo $_smarty_tpl->getValue('product')->getStock();?>
</p>
      <p>Type: <?php echo $_smarty_tpl->getValue('product')->getType();?>
</p>

      <?php if ($_smarty_tpl->getValue('product')->getStock() > 0) {?>
        <a href="index.php?action=add_to_cart&product_id=<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
          <button>In mijn winkelwagen</button>
        </a>
      <?php } else { ?>
        <button disabled>Niet op voorraad</button>
      <?php }?>
    </div>
  </div>

  <a class="back-link" href="index.php?page=productList">← Terug naar overzicht</a>
<?php } else { ?>
  <h1>Product niet gevonden</h1>
  <p>Het gevraagde product bestaat niet.</p>
  <a class="back-link" href="index.php?page=productList">← Terug naar overzicht</a>
<?php }?>

</body>
</html>
<?php }
}
