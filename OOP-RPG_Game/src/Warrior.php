<?php

namespace Game;

class Warrior extends Character
{
    private int $rage = 100;
    private int $originalRage;
    protected array $specialAttacks = [];

    public function __construct()
    {
        $this->specialAttacks = ['rageAttack', 'whirlwind'];
        $this->originalRage = $this->rage;
    }

    public function getRage(): int {
        return $this->rage;
    }

    public function setRage(int $rage): void {
        $this->rage = $rage;
    }

    public function getSummary(): string {
        return parent::getSummary() . ", Rage: {$this->rage}";
    }

    public function performRageAttack(): string {
        if ($this->rage < 25) {
            return "Not enough rage to perform rage attack!";
        }

        // Bereken tijdelijke modifiers
        $tempAttack = (int)($this->attack * 0.75);
        $tempDefense = (int)($this->defence * -0.3);

        // Gebruik de protected methode
        $resultMessage = $this->modifyTemporaryStats($tempAttack, $tempDefense);

        // Verminder rage
        $this->rage -= 25;

        return "Performed rage attack! {$resultMessage} Rage left: {$this->rage}.";
    }

    public function performWhirlwind(): string {
        if ($this->rage < 35) {
            return "Not enough rage to perform whirlwind!";
        }

        // Bereken tijdelijke modifiers: attack 60%, defense 50%
        $tempAttack = (int)($this->attack * 0.6);
        $tempDefense = (int)($this->defence * 0.5);

        $this->modifyTemporaryStats($tempAttack - $this->attack, $tempDefense - $this->defence);

        // Verminder rage
        $this->rage -= 35;

        return "Performed whirlwind attack! Attack reduced to 60%, Defense reduced to 50%. Rage left: {$this->rage}.";
    }

    // Implementatie van abstracte methode
    public function executeSpecialAttack(string $attackName): string {
        switch ($attackName) {
            case 'rageAttack':
                return $this->performRageAttack();
            case 'whirlwind':
                return $this->performWhirlwind();
            default:
                return "Error: Unknown special attack '{$attackName}'!";
        }
    }

    // Implementatie van abstracte methode
    public function resetAttributes(): void {
        $this->rage = $this->originalRage;
        $this->resetTempStats();
    }
}
