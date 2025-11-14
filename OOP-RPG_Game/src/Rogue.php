<?php

namespace Game;

class Rogue extends Character
{
    private int $energy = 100;
    private int $originalEnergy;
    protected array $specialAttacks = [];

    public function __construct()
    {
        $this->specialAttacks = ['sneakAttack', 'poisonDagger'];
        $this->originalEnergy = $this->energy;
    }

    public function getEnergy(): int {
        return $this->energy;
    }

    public function setEnergy(int $energy): void {
        $this->energy = $energy;
    }

    public function performSneakAttack(): string {
        if ($this->energy < 20) {
            return "Not enough energy to perform sneak attack!";
        }

        $tempAttack = $this->attack * 2;              // Dubbele attack
        $tempDefense = (int)($this->defence * -0.4);  // 40% minder defense

        $resultMessage = $this->modifyTemporaryStats($tempAttack, $tempDefense);

        $this->energy -= 20;

        return "Performed sneak attack! {$resultMessage} Energy left: {$this->energy}.";
    }

    public function usePoisonDagger(): string {
        if ($this->energy < 30) {
            return "Not enough energy to use poison dagger!";
        }

        $tempAttack = (int)($this->attack * 0.8);
        $tempDefense = (int)($this->defence * 0.7);

        $this->modifyTemporaryStats($tempAttack - $this->attack, $tempDefense - $this->defence);

        $this->energy -= 30;

        return "Used poison dagger! Attack set to 80%, Defense set to 70%. Energy left: {$this->energy}.";
    }

    // Implementatie van abstracte methode
    public function executeSpecialAttack(string $attackName): string {
        switch ($attackName) {
            case 'sneakAttack':
                return $this->performSneakAttack();
            case 'poisonDagger':
                return $this->usePoisonDagger();
            default:
                return "Error: Unknown special attack '{$attackName}'!";
        }
    }

    // Implementatie van abstracte methode
    public function resetAttributes(): void {
        $this->energy = $this->originalEnergy;
        $this->resetTempStats();
    }
}
