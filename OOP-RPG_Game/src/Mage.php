<?php

namespace Game;

class Mage extends Character
{
    private int $mana = 100;
    private int $originalMana;
    protected array $specialAttacks = [];

    public function __construct()
    {
        $this->specialAttacks = ['fireball', 'frostNova'];
        $this->originalMana = $this->mana;
    }

    public function getMana(): int {
        return $this->mana;
    }

    public function setMana(int $mana): void {
        $this->mana = $mana;
    }

    public function getSummary(): string {
        return parent::getSummary() . ", Mana: {$this->mana}";
    }

    public function castFireball(): string {
        if ($this->mana < 30) {
            return "Not enough mana to cast fireball!";
        }

        $tempAttack = (int)($this->attack * 1.5);
        $tempDefense = (int)($this->defence * -0.2);

        $resultMessage = $this->modifyTemporaryStats($tempAttack, $tempDefense);

        $this->mana -= 30;

        return "Cast fireball! {$resultMessage} Mana left: {$this->mana}.";
    }

    public function castFrostNova(): string {
        if ($this->mana < 45) {
            return "Not enough mana to cast frost nova!";
        }

        $tempAttack = (int)($this->attack * 0.4);
        $tempDefense = (int)($this->defence * 1.2);

        // Pas tijdelijke stats aan ten opzichte van de originele waarden
        $this->modifyTemporaryStats($tempAttack - $this->attack, $tempDefense - $this->defence);

        $this->mana -= 45;

        return "Cast Frost Nova! Attack reduced to 40%, Defense increased to 120%. Mana left: {$this->mana}.";
    }

    // Implementatie van abstracte methode
    public function executeSpecialAttack(string $attackName): string {
        switch ($attackName) {
            case 'fireball':
                return $this->castFireball();
            case 'frostNova':
                return $this->castFrostNova();
            default:
                return "Error: Unknown special attack '{$attackName}'!";
        }
    }

    // Implementatie van abstracte methode
    public function resetAttributes(): void {
        $this->mana = $this->originalMana;
        $this->resetTempStats();
    }
}
