<?php
/* Smarty version 5.4.3, created on 2025-09-18 09:14:40
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbcd80920342_02802738',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d19a3c67b5523193a4acd34577e106ee3d694df' => 
    array (
      0 => 'layout.tpl',
      1 => 1758186869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbcd80920342_02802738 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPG Game</title>
    <link href="./templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="./templates/css/sticky-footer-navbar.css" rel="stylesheet">
    <style>
        /* Main full height minus header/footer, inhoud gecentreerd */
        main.flex-shrink-0 {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 112px); /* header + footer hoogte approx */
        }
    </style>
</head>
<body class="d-flex flex-column h-100">

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?page=home">RPG Game</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo '<?php'; ?>
 if($page == 'home') echo 'active'; <?php echo '?>'; ?>
" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo '<?php'; ?>
 if($page == 'createCharacter') echo 'active'; <?php echo '?>'; ?>
" href="index.php?page=createCharacter">Create Character</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo '<?php'; ?>
 if($page == 'characterList') echo 'active'; <?php echo '?>'; ?>
" href="index.php?page=characterList">Character List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo '<?php'; ?>
 if($page == 'characterStats') echo 'active'; <?php echo '?>'; ?>
" href="index.php?page=characterStats">Character Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=testDatabase">Test Database</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=createItem">Create Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=listItems">Item List</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<main class="flex-shrink-0">
    <div class="container text-center">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_177341394168cbcd8091e410_01223697', "content");
?>

    </div>
</main>

<?php echo '<script'; ?>
 src="./templates/js/bootstrap.bundle.min.js" defer><?php echo '</script'; ?>
>

<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container text-center">
        <span class="text-body-secondary">RPG Game &copy; 2025</span>
    </div>
</footer>

</body>
</html>
<?php }
/* {block "content"} */
class Block_177341394168cbcd8091e410_01223697 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\joche\\PhpstormProjects\\untitled\\templates';
}
}
/* {/block "content"} */
}
