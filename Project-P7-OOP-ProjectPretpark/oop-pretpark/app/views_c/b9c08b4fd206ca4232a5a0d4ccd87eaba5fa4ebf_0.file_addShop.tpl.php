<?php
/* Smarty version 5.5.2, created on 2025-10-02 07:05:55
  from 'file:addShop.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68de2453daa8b2_64109513',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9c08b4fd206ca4232a5a0d4ccd87eaba5fa4ebf' => 
    array (
      0 => 'addShop.tpl',
      1 => 1759388567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68de2453daa8b2_64109513 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\oop-pretpark\\app\\views';
?><h1>Nieuwe Shop toevoegen</h1>
<nav><a href="index.php">← Terug naar Home</a></nav>

<?php echo '<?php'; ?>
 if ($message) echo "<p style='color:green'><?php echo $_smarty_tpl->getValue('message');?>
</p>"; <?php echo '?>'; ?>

<?php echo '<?php'; ?>
 if ($error) echo "<p style='color:red'><?php echo $_smarty_tpl->getValue('error');?>
</p>"; <?php echo '?>'; ?>


<form method="post" action="index.php?page=addShop">
    <label>Name:</label>
    <input type="text" name="name" required value="<?php echo '<?'; ?>
= htmlspecialchars($_POST['name'] ?? '') <?php echo '?>'; ?>
"><br><br>

    <label>Type:</label>
    <select name="type_code" required>
        <option value="">-- Select Type --</option>
        <?php echo '<?php'; ?>
 foreach ($shopTypes as $code => $typeNameOption): <?php echo '?>'; ?>

        <option value="<?php echo '<?'; ?>
= $code <?php echo '?>'; ?>
" <?php echo '<?'; ?>
= (($_POST['type_code'] ?? '') === $code) ? 'selected' : '' <?php echo '?>'; ?>
>
        <?php echo '<?'; ?>
= $code <?php echo '?>'; ?>
 - <?php echo '<?'; ?>
= htmlspecialchars($typeNameOption) <?php echo '?>'; ?>

        </option>
        <?php echo '<?php'; ?>
 endforeach; <?php echo '?>'; ?>

    </select><br><br>



    <label>Location:</label>
    <select name="location">
        <option value="">-- Select Location --</option>
        <?php echo '<?php'; ?>
 foreach ($shopLocations as $code => $locName): <?php echo '?>'; ?>

        <option value="<?php echo '<?'; ?>
= htmlspecialchars($locName) <?php echo '?>'; ?>
" <?php echo '<?'; ?>
= (($_POST['location'] ?? '') === $locName) ? 'selected' : '' <?php echo '?>'; ?>
>
        <?php echo '<?'; ?>
= $code <?php echo '?>'; ?>
 - <?php echo '<?'; ?>
= htmlspecialchars($locName) <?php echo '?>'; ?>

        </option>
        <?php echo '<?php'; ?>
 endforeach; <?php echo '?>'; ?>

    </select><br><br>



    <label>Rating:</label>
    <select name="rating">
        <option value="0">-- Select Rating --</option>
        <?php echo '<?php'; ?>
 for ($i = 1; $i <= 5; $i++): <?php echo '?>'; ?>

        <option value="<?php echo '<?'; ?>
= $i <?php echo '?>'; ?>
" <?php echo '<?'; ?>
= (($_POST['rating'] ?? 0) == $i) ? 'selected' : '' <?php echo '?>'; ?>
><?php echo '<?'; ?>
= $i <?php echo '?>'; ?>
 ⭐</option>
        <?php echo '<?php'; ?>
 endfor; <?php echo '?>'; ?>

    </select><br><br>

    <button type="submit">Add Shop</button>
</form>
<?php }
}
