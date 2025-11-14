<?php

namespace Game;

use Exception;

/**
 * Class Item
 *
 * Vertegenwoordigt een item dat kan worden gebruikt door karakters in het spel.
 */
class Item
{
    private ?int $id;
    private string $name;
    private string $type;
    private float $value;

    public function __construct(string $name, string $type, float $value, ?int $id = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        $idPart = $this->id !== null ? "ID: {$this->id}, " : "";
        return "{$idPart}Name: {$this->name}, Type: {$this->type}, Value: {$this->value}";
    }

    public function toDatabaseArray(): array
    {
        return [
            'name'  => $this->name,
            'type'  => $this->type,
            'value' => $this->value
        ];
    }

    public function save(): bool
    {
        try {
            $db = DatabaseManager::getInstance();
            if (!$db) {
                throw new Exception("Database instance not available.");
            }

            $newId = $db->insert('items', $this->toDatabaseArray());
            $this->setId($newId);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update dit item in de database.
     *
     * @return bool True bij succes, false bij falen
     */
    public function update(): bool
    {
        if ($this->id === null) {
            return false; // Kan niet updaten zonder ID
        }

        try {
            $db = DatabaseManager::getInstance();
            if (!$db) {
                throw new Exception("Database instance not available.");
            }

            $affectedRows = $db->update('items', $this->toDatabaseArray(), ['id' => $this->id]);
            return $affectedRows > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Verwijder dit item uit de database.
     *
     * @return bool True bij succes, false bij falen
     */
    public function delete(): bool
    {
        if ($this->id === null) {
            return false; // Kan niet verwijderen zonder ID
        }

        try {
            $db = DatabaseManager::getInstance();
            if (!$db) {
                throw new Exception("Database instance not available.");
            }

            $affectedRows = $db->delete('items', ['id' => $this->id]);
            return $affectedRows > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Laad een item vanuit de database op basis van ID.
     *
     * @param int $id
     * @return Item|null
     */
    public static function loadFromDatabase(int $id): ?Item
    {
        try {
            $db = DatabaseManager::getInstance();
            if (!$db) {
                throw new Exception("Database instance not available.");
            }

            $rows = $db->select(['items' => ['*']], ['id' => $id]);
            if (count($rows) === 0) {
                return null;
            }

            $row = $rows[0];
            return new Item(
                $row['name'] ?? '',
                $row['type'] ?? '',
                (float)($row['value'] ?? 0),
                isset($row['id']) ? (int)$row['id'] : null
            );
        } catch (Exception $e) {
            return null;
        }
    }
}
