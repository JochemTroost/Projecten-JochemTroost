<br>
<br>
<br>
<br>
<div style="text-align: center">
<h2>Character Details</h2>

<p><strong>Naam:</strong> {$character->getName()}</p>
<p><strong>Rol:</strong> {$character->getRole()}</p>
<p><strong>Health:</strong> {$character->getHealth()}</p>
<p><strong>Aanval:</strong> {$character->getAttack()}</p>
<p><strong>Verdediging:</strong> {$character->getDefence()}</p>
<p><strong>Range:</strong> {$character->getRange()}</p>

{if $character->getRole() == "Warrior"}
    <p><strong>Rage:</strong> {$character->getRage()}</p>
{/if}

{if $character->getRole() == "Mage"}
    <p><strong>Mana:</strong> {$character->getMana()}</p>
{/if}

{if $character->getRole() == "Rogue"}
    <p><strong>Energy:</strong> {$character->getEnergy()}</p>
{/if}

{if $character->getRole() == "Healer"}
    <p><strong>Spirit:</strong> {$character->getSpirit()}</p>
{/if}

{if $character->getRole() == "Tank"}
    <p><strong>Shield:</strong> {$character->getShield()}</p>
{/if}

<p><a href="index.php?page=characterList">Terug naar Character List</a></p>
</div>
{include file='layout.tpl'}