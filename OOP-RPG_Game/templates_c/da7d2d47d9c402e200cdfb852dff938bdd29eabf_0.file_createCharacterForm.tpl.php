<?php
/* Smarty version 5.4.3, created on 2025-09-18 10:46:34
  from 'file:createCharacterForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_68cbe30a569894_25541494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da7d2d47d9c402e200cdfb852dff938bdd29eabf' => 
    array (
      0 => 'createCharacterForm.tpl',
      1 => 1758113760,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68cbe30a569894_25541494 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_123880021368cbe30a566838_66274025', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_123880021368cbe30a566838_66274025 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\untitled\\templates';
?>

    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h3>Create a New Character</h3>
            </div>
            <div class="card-body">
                <form action="index.php?page=saveCharacter" method="POST">

                    <div class="mb-3">
                        <label for="name" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Selecteer een rol</option>
                            <option value="Warrior">Warrior</option>
                            <option value="Mage">Mage</option>
                            <option value="Rogue">Rogue</option>
                            <option value="Healer">Healer</option>
                            <option value="Tank">Tank</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="health" class="form-label">Health</label>
                        <input type="number" class="form-control" id="health" name="health" min="50" max="200" value="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="attack" class="form-label">Attack</label>
                        <input type="number" class="form-control" id="attack" name="attack" min="10" max="50" value="20" required>
                    </div>

                    <div class="mb-3">
                        <label for="defence" class="form-label">Defence</label>
                        <input type="number" class="form-control" id="defence" name="defence" min="5" max="30" value="10" required>
                    </div>

                    <div class="mb-3">
                        <label for="range" class="form-label">Range</label>
                        <input type="number" class="form-control" id="range" name="range" min="1" max="10" value="1" required>
                    </div>

                    <!-- Warrior Rage Field -->
                    <div class="mb-3" id="rageField">
                        <label for="rage" class="form-label">Rage</label>
                        <input type="number" class="form-control" id="rage" name="rage" min="0" max="100" value="100">
                    </div>

                    <!-- Mage Mana Field -->
                    <div class="mb-3" id="manaField">
                        <label for="mana" class="form-label">Mana</label>
                        <input type="number" class="form-control" id="mana" name="mana" min="0" max="100" value="100">
                    </div>

                    <!-- Rogue Energy Field -->
                    <div class="mb-3" id="energyField">
                        <label for="energy" class="form-label">Energy</label>
                        <input type="number" class="form-control" id="energy" name="energy" min="0" max="100" value="100">
                    </div>

                    <!-- Healer Spirit Field -->
                    <div class="mb-3" id="spiritField">
                        <label for="spirit" class="form-label">Spirit</label>
                        <input type="number" class="form-control" id="spirit" name="spirit" min="0" max="100" value="100">
                    </div>

                    <!-- Tank Shield Field -->
                    <div class="mb-3" id="shieldField">
                        <label for="shield" class="form-label">Shield</label>
                        <input type="number" class="form-control" id="shield" name="shield" min="0" max="100" value="50">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Character</button>
                </form>
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
>
        function toggleFields() {
            var role = document.getElementById('role').value;
            document.getElementById('rageField').style.display = (role === 'Warrior') ? 'block' : 'none';
            document.getElementById('manaField').style.display = (role === 'Mage') ? 'block' : 'none';
            document.getElementById('energyField').style.display = (role === 'Rogue') ? 'block' : 'none';
            document.getElementById('spiritField').style.display = (role === 'Healer') ? 'block' : 'none';
            document.getElementById('shieldField').style.display = (role === 'Tank') ? 'block' : 'none';
        }

        document.getElementById('role').addEventListener('change', toggleFields);
        // Call the function on page load to set the initial state
        toggleFields();
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
