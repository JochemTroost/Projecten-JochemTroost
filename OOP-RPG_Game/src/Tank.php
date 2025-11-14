<?php

namespace Game;

class Tank extends Character
{
    private int $shield;
    private int $originalShield;
    protected array $specialAttacks = [];

    // Constructor
    public function __construct(
        string $name,
        string $role,
        int $health,
        int $attack,
        int $defence = 10,
        int $range = 1,
        int $shield = 50
    ) {
        // Zet de algemene properties via parent
        $this->setCharacter($name, $role, $health, $defence, $range, $attack);

        // Stel het schild in
        $this->shield = $shield;
        $this->originalShield = $shield;

        // Speciale aanvallen
        $this->specialAttacks = ['barrierShield', 'taunt'];
    }

    // Getter voor shield
    public function getShield(): int
    {
        return $this->shield;
    }

    // Setter voor shield
    public function setShield(int $shield): void
    {
        $this->shield = $shield;
    }

    // Override getSummary
    public function getSummary(): string
    {
        $baseSummary = parent::getSummary();
        return $baseSummary . " This tank has a shield with {$this->shield} durability.";
    }

    // Speciale methode activateBarrierShield
    public function activateBarrierShield(): string
    {
        if ($this->shield < 15) {
            return "Not enough shield durability to activate barrier!";
        }

        // Verhoog defense tijdelijk met 100%
        $originalDefence = $this->getDefence();
        $newDefense = $originalDefence * 2;

        // Verminder aanval tijdelijk met 50%
        $originalAttack = $this->getAttack();
        $newAttack = intdiv($originalAttack, 2);

        // Pas tijdelijke stats toe
        $this->modifyTemporaryStats($newAttack - $originalAttack, $newDefense - $originalDefence);

        // Verminder shield met 15
        $this->shield -= 15;

        return "Raised shield for maximum defense! Attack reduced by 50%.";
    }

    // Nieuwe speciale aanval: Taunt
    public function performTaunt(): string
    {
        if ($this->shield < 10) {
            return "Not enough shield durability to perform Taunt!";
        }

        $tempAttack = (int)($this->getAttack() * 0.4);
        $tempDefense = (int)($this->getDefence() * 1.3);

        $this->modifyTemporaryStats($tempAttack - $this->getAttack(), $tempDefense - $this->getDefence());

        $this->shield -= 10;

        return "Performed Taunt! Attack set to 40%, Defense increased to 130%. Shield left: {$this->shield}.";
    }

    // Implementatie van abstracte methode
    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'barrierShield':
                return $this->activateBarrierShield();
            case 'taunt':
                return $this->performTaunt();
            default:
                return "Error: Unknown special attack '{$attackName}'!";
        }
    }

    // Implementatie van abstracte methode
    public function resetAttributes(): void
    {
        $this->shield = $this->originalShield;
        $this->resetTempStats();
    }
}
