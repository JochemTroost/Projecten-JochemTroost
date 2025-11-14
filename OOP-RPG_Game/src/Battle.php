<?php

namespace Game;

class Battle {
    private string $battleLog = "";
    private int $maxRounds = 10;
    private int $roundNumber = 1;
    private array $selectedAttacks = ['fighter1' => null, 'fighter2' => null];

    public function __construct()
    {
        $this->battleLog = "";
    }

    public function getBattleLog(): string {
        return $this->battleLog;
    }

    public function getMaxRounds(): int {
        return $this->maxRounds;
    }

    public function getRoundNumber(): int {
        return $this->roundNumber;
    }

    public function changeMaxRounds(int $rounds): void {
        if ($rounds > 0) {
            $this->maxRounds = $rounds;
        }
    }

    /**
     * @param Character $attacker
     * @param Character $defender
     * @return int
     */
    private function calculateDamage(Character $attacker, Character $defender): int {
        $attackPower = $attacker->getAttack();
        $defensePower = $defender->getDefence();

        $randomFactor = rand(70, 100) / 100;
        $damage = max(1, round(($attackPower * $randomFactor) - $defensePower));

        return (int)$damage;
    }

    private function logAttack(Character $attacker, Character $defender, int $damage): void {
        $this->battleLog .= "{$attacker->getName()} attacks {$defender->getName()} for {$damage} damage. ";
        $this->battleLog .= "{$defender->getName()} health: {$defender->getHealth()}\n";
    }

    // Methode om een speciale aanval in te stellen
    public function setAttackForFighter(Character $fighter, ?string $attackName): void {
        if ($fighter === null) return;

        if (!isset($this->selectedAttacks['fighter1'])) {
            $this->selectedAttacks['fighter1'] = $attackName;
        } else {
            $this->selectedAttacks['fighter2'] = $attackName;
        }
    }

    // Voer een aanval uit (normaal of speciale aanval)
    private function executeAttack(Character $attacker, Character $defender, ?string $specialAttack = null): void {
        $attackMessage = "";

        if ($specialAttack !== null) {
            $attackMessage = $attacker->executeSpecialAttack($specialAttack);
            $this->battleLog .= "{$attacker->getName()} uses special attack '{$specialAttack}': {$attackMessage}\n";
        }

        $damage = $this->calculateDamage($attacker, $defender);
        $defender->takeDamage($damage);
        $this->logAttack($attacker, $defender, $damage);
    }

    // Voer een beurt uit
    public function executeTurn(Character $fighter1, Character $fighter2): void {
        // Voer special attacks uit indien geselecteerd
        $this->executeAttack($fighter1, $fighter2, $this->selectedAttacks['fighter1']);
        if ($fighter2->getHealth() <= 0) {
            $this->battleLog .= "{$fighter2->getName()} has been defeated!\n";
            return;
        }

        $this->executeAttack($fighter2, $fighter1, $this->selectedAttacks['fighter2']);
        if ($fighter1->getHealth() <= 0) {
            $this->battleLog .= "{$fighter1->getName()} has been defeated!\n";
            return;
        }

        // Reset na de beurt
        $this->selectedAttacks['fighter1'] = null;
        $this->selectedAttacks['fighter2'] = null;

        $fighter1->resetTempStats();
        $fighter2->resetTempStats();

        $this->roundNumber++;
    }

    // Start het gevecht
    public function startFight(Character $fighter1, Character $fighter2): string {
        $this->battleLog = "Battle Start!\n";
        $fighter1->resetTempStats();
        $fighter2->resetTempStats();

        while ($fighter1->getHealth() > 0 && $fighter2->getHealth() > 0) {
            $this->executeTurn($fighter1, $fighter2);

            if ($this->roundNumber > $this->maxRounds) {
                $this->battleLog .= "The battle has ended due to the round limit.\n";
                $this->changeMaxRounds($this->maxRounds + 10);
                break;
            }
        }

        return $this->battleLog;
    }
}
