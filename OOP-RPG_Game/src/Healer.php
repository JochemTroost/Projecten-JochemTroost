<?php

namespace Game;

class Healer extends Character
{
    private int $spirit = 100;
    private int $originalSpirit;
    protected array $specialAttacks = [];

    public function __construct()
    {
        $this->specialAttacks = ['healingPrayer', 'divineShield'];
        $this->originalSpirit = $this->spirit;
    }

    // Getter voor spirit
    public function getSpirit(): int {
        return $this->spirit;
    }

    // Setter voor spirit
    public function setSpirit(int $spirit): void {
        $this->spirit = $spirit;
    }

    /**
     * Voert een healing prayer uit:
     * - Controleert of er voldoende spirit is
     * - Herstelt 20 health
     * - Verhoogt tijdelijk defense
     */
    public function performHealingPrayer(): string {
        if ($this->spirit < 30) {
            return "Not enough spirit to perform healing prayer!";
        }

        // Heal 20 health, zonder boven de max health uit te komen
        $newHealth = min($this->getHealth() + 20, 200);
        $this->setHealth($newHealth);

        // Verhoog tijdelijk defense (2x huidige defense)
        $tempDefense = $this->getDefence() * 2;
        $resultMessage = $this->modifyTemporaryStats(0, $tempDefense);

        // Verminder spirit
        $this->spirit -= 30;

        return "Healing prayer restores 20 health and doubles defense temporarily! {$resultMessage} Spirit left: {$this->spirit}.";
    }

    /**
     * Nieuwe speciale aanval: Divine Shield
     */
    public function castDivineShield(): string {
        if ($this->spirit < 60) {
            return "Not enough spirit to cast Divine Shield!";
        }

        $tempAttack = (int)($this->attack * 0.3);
        $tempDefense = (int)($this->defence * 1.5);

        $this->modifyTemporaryStats($tempAttack - $this->attack, $tempDefense - $this->defence);

        $this->spirit -= 60;

        return "Cast Divine Shield! Attack reduced to 30%, Defense increased to 150%. Spirit left: {$this->spirit}.";
    }

    // Implementatie van abstracte methode
    public function executeSpecialAttack(string $attackName): string {
        switch ($attackName) {
            case 'healingPrayer':
                return $this->performHealingPrayer();
            case 'divineShield':
                return $this->castDivineShield();
            default:
                return "Error: Unknown special attack '{$attackName}'!";
        }
    }

    // Implementatie van abstracte methode
    public function resetAttributes(): void {
        $this->spirit = $this->originalSpirit;
        $this->resetTempStats();
    }
}
