<?php
namespace Game;

/**
 * Class DatabaseManager
 *
 * Singleton-achtige manager voor de database connectie.
 * Houdt een statische instance van een Database implementatie bij.
 *
 * @package Game
 */
class DatabaseManager
{
    /**
     * @var ?Database $instance De actieve database instance (of null als niet gezet)
     */
    private static ?Database $instance = null;

    /**
     * Zet de database instance.
     *
     * @param Database $database Een object dat Database implementeert
     * @return void
     */
    public static function setInstance(Database $database): void
    {
        self::$instance = $database;
    }

    /**
     * Haal de huidige database instance op.
     *
     * @return ?Database De huidige database instance of null
     */
    public static function getInstance(): ?Database
    {
        return self::$instance;
    }

    /**
     * Controleer of er een database instance aanwezig is.
     *
     * @return bool True als er een instance gezet is, false anders
     */
    public static function hasInstance(): bool
    {
        return self::$instance !== null;
    }
}
