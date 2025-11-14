<?php

namespace Game;

abstract class Character
{
    // Statics
    public static int $totalCharacters = 0;
    public static array $characterTypes = [];
    public static array $existingNames = [];

    // Private properties
    private string $name;
    private string $role;
    private int $health;
    private int $range;
    private Inventory $inventory;

    // Protected properties
    protected int $attack;
    protected int $defence;
    protected int $tempAttack = 0;
    protected int $tempDefense = 0;

    // Nieuw: lijst van speciale aanvallen
    protected array $specialAttacks = [];

    public function __construct(
        string $name = "",
        string $role = "",
        int $health = 0,
        int $defence = 0,
        int $range = 1,
        int $attack = 2
    ) {
        if ($name !== "" && $role !== "") {
            // Initialize properties via setCharacter
            $this->setCharacter($name, $role, $health, $defence, $range, $attack);

            // Houd statistieken bij
            self::$totalCharacters++;
            self::$characterTypes[] = $role;
            self::$existingNames[] = $name;
        }
    }

    public function setCharacter(
        string $name,
        string $role,
        int $health,
        int $defence,
        int $range = 1,
        int $attack = 2
    ): void {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->defence = $defence;
        $this->range = $range;
        $this->attack = $attack;
        $this->inventory = new Inventory();
    }

    // Public getters
    public function getName(): string { return $this->name; }
    public function getRole(): string { return $this->role; }
    public function getHealth(): int { return $this->health; }
    public function getRange(): int { return $this->range; }
    public function getInventory(): Inventory { return $this->inventory; }

    public function getAttack(): int { return $this->attack + $this->tempAttack; }
    public function getDefence(): int { return $this->defence + $this->tempDefense; }

    public function setHealth(int $newHealth): string {
        if ($newHealth >= 0) {
            $this->health = $newHealth;
            return "Health successfully updated";
        }
        return "Health cannot be lower than 0";
    }

    public function takeDamage(int $damage): void {
        $newHealth = max(0, $this->health - $damage);
        $this->setHealth($newHealth);
    }

    public function resetTempStats(): void {
        $this->tempAttack = 0;
        $this->tempDefense = 0;
    }

    protected function modifyTemporaryStats(int $attackMod, int $defenseMod): string {
        $this->tempAttack = $attackMod;
        $this->tempDefense = $defenseMod;
        return "Temporary stats modified: Attack = {$this->tempAttack}, Defense = {$this->tempDefense}";
    }

    public function getSummary(): string {
        return "{$this->name} - Role: {$this->role}, Health: {$this->health}, Attack: {$this->attack}, Defense: {$this->defence}";
    }

    // Nieuw: speciale aanvallen ophalen
    public function getSpecialAttacks(): array {
        return $this->specialAttacks;
    }

    // ---------- Nieuw: Static session/statistics methods ----------

    // Private: laad statistieken uit session
    private static function loadFromSession(): void {
        if (isset($_SESSION['characterStats']) && is_array($_SESSION['characterStats'])) {
            self::$totalCharacters = $_SESSION['characterStats']['totalCharacters'] ?? 0;
            self::$characterTypes  = $_SESSION['characterStats']['characterTypes'] ?? [];
            self::$existingNames   = $_SESSION['characterStats']['existingNames'] ?? [];
        }
    }

    // Private: sla statistieken op in session
    private static function saveToSession(): void {
        $_SESSION['characterStats'] = [
            'totalCharacters' => self::$totalCharacters,
            'characterTypes'  => self::$characterTypes,
            'existingNames'   => self::$existingNames,
        ];
    }

    // Public: initialiseer statics uit session
    public static function initializeSession(): void {
        self::loadFromSession();
    }

    // Public: sla statics op naar session
    public static function saveSession(): void {
        self::saveToSession();
    }

    // Public getter voor totaal aantal characters
    public static function getTotalCharacters(): int {
        return self::$totalCharacters;
    }

    // Public getter voor alle namen
    public static function getAllCharacterNames(): array {
        return self::$existingNames;
    }

    // Public getter voor alle types
    public static function getAllCharacterTypes(): array {
        return self::$characterTypes;
    }

    // Reset alle statistieken naar beginwaarden
    public static function resetAllStatistics(): void {
        self::$totalCharacters = 0;
        self::$characterTypes = [];
        self::$existingNames = [];
    }

    // Recalculate statistieken op basis van een CharacterList
    public static function recalculateStatistics(CharacterList $characterList): void {
        self::resetAllStatistics();
        foreach ($characterList->getCharacters() as $char) {
            if ($char instanceof Character) {
                self::$totalCharacters++;
                self::$characterTypes[] = $char->getRole();
                self::$existingNames[] = $char->getName();
            }
        }
    }

    // Verwijder een character uit de statistieken
    public static function removeCharacterFromStats(string $name, string $role): void {
        $nameKey = array_search($name, self::$existingNames, true);
        $roleKey = array_search($role, self::$characterTypes, true);

        if ($nameKey !== false && $roleKey !== false) {
            self::$totalCharacters = max(0, self::$totalCharacters - 1);

            unset(self::$existingNames[$nameKey]);
            unset(self::$characterTypes[$roleKey]);

            self::$existingNames = array_values(self::$existingNames);
            self::$characterTypes = array_values(self::$characterTypes);
        }
    }

    // Abstracte methoden voor subclasses
    abstract public function executeSpecialAttack(string $attackName): string;
    abstract public function resetAttributes(): void;
}
