{extends file="layout.tpl"}

{block name="content"}
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

    <script>
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
    </script>
{/block}
