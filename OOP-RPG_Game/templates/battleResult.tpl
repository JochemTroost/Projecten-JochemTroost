{* battleResult.tpl *}
{extends file='layout.tpl'}

{block name="content"}
    <h2>Battle Arena</h2>

    <form action="index.php?page=battleRound" method="POST">
        <div class="row mb-3">
            <div class="col">
                <h4>{$fighter1->getName()} ({$fighter1->getRole()})</h4>
                <p><strong>Health:</strong> {$fighter1->getHealth()}</p>
                {if $fighter1->getRole() == "Warrior"}
                    <p><strong>Rage:</strong> {$fighter1->getRage()}</p>
                {/if}
                {if $fighter1->getRole() == "Mage"}
                    <p><strong>Mana:</strong> {$fighter1->getMana()}</p>
                {/if}
                {if $fighter1->getRole() == "Rogue"}
                    <p><strong>Energy:</strong> {$fighter1->getEnergy()}</p>
                {/if}
                {if $fighter1->getRole() == "Healer"}
                    <p><strong>Spirit:</strong> {$fighter1->getSpirit()}</p>
                {/if}
                {if $fighter1->getRole() == "Tank"}
                    <p><strong>Shield:</strong> {$fighter1->getShield()}</p>
                {/if}

                <label for="fighter1Attack" class="form-label">Select Attack</label>
                <select id="fighter1Attack" name="fighter1Attack" class="form-select" {if $fighter1->getHealth() <= 0}disabled{/if}>
                    <option value="">Normal Attack</option>
                    {foreach $fighter1->getSpecialAttacks() as $attack}
                        <option value="{$attack}">{$attack|capitalize}</option>
                    {/foreach}
                </select>
            </div>

            <div class="col">
                <h4>{$fighter2->getName()} ({$fighter2->getRole()})</h4>
                <p><strong>Health:</strong> {$fighter2->getHealth()}</p>
                {if $fighter2->getRole() == "Warrior"}
                    <p><strong>Rage:</strong> {$fighter2->getRage()}</p>
                {/if}
                {if $fighter2->getRole() == "Mage"}
                    <p><strong>Mana:</strong> {$fighter2->getMana()}</p>
                {/if}
                {if $fighter2->getRole() == "Rogue"}
                    <p><strong>Energy:</strong> {$fighter2->getEnergy()}</p>
                {/if}
                {if $fighter2->getRole() == "Healer"}
                    <p><strong>Spirit:</strong> {$fighter2->getSpirit()}</p>
                {/if}
                {if $fighter2->getRole() == "Tank"}
                    <p><strong>Shield:</strong> {$fighter2->getShield()}</p>
                {/if}

                <label for="fighter2Attack" class="form-label">Select Attack</label>
                <select id="fighter2Attack" name="fighter2Attack" class="form-select" {if $fighter2->getHealth() <= 0}disabled{/if}>
                    <option value="">Normal Attack</option>
                    {foreach $fighter2->getSpecialAttacks() as $attack}
                        <option value="{$attack}">{$attack|capitalize}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" {if $fighter1->getHealth() <= 0 || $fighter2->getHealth() <= 0}disabled{/if}>Fight Round</button>
    </form>

    <hr>

    <h4>Battle Log</h4>
    <pre>{$battleLog}</pre>

{/block}
