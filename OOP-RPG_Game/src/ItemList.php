<?php

namespace Game;

use Exception;

/**
 * Class ItemList
 *
 * Beheert een collectie van Item objecten.
 */
class ItemList
{
    /** @var Item[] Array van Item objecten */
    private array $items = [];

    /**
     * Voeg een Item toe aan de collectie.
     *
     * @param Item $item
     */
    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Haal alle Items op.
     *
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Tel het aantal Items in de collectie.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Laad alle items uit de database.
     *
     * @return $this
     * @throws Exception
     */
    public function loadAllFromDatabase(): ItemList
    {
        return $this->loadByParams([]);
    }

    /**
     * Laad items uit de database op basis van zoekparameters.
     *
     * @param array $params Associatieve array ['id' => 1, 'type' => 'weapon', 'minValue' => 50, 'name' => 'Sword']
     * @return $this
     * @throws Exception
     */
    public function loadByParams(array $params = []): ItemList
    {
        $database = DatabaseManager::getInstance();
        if (!$database) {
            throw new Exception("Geen database instantie beschikbaar.");
        }

        // filter lege waarden
        $params = array_filter($params, fn($v) => $v !== null && $v !== '');

        $conditions = [];
        if (isset($params['id'])) {
            $conditions['id'] = (int)$params['id'];
        }
        if (isset($params['type'])) {
            $conditions['type'] = $params['type'];
        }
        if (isset($params['minValue'])) {
            $conditions['value >='] = (float)$params['minValue'];
        }
        if (isset($params['name'])) {
            $conditions['name LIKE'] = $params['name'];
        }

        $rows = $database->select(['items' => ['*']], $conditions);

        $this->items = []; // clear previous items
        foreach ($rows as $row) {
            $item = $this->createItemFromDatabaseRow($row);
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Zoek een item op basis van ID.
     *
     * @param int $id
     * @return Item|null
     * @throws Exception
     */
    public function findById(int $id): ?Item
    {
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }

        $database = DatabaseManager::getInstance();
        if (!$database) {
            throw new Exception("Geen database instantie beschikbaar.");
        }

        $rows = $database->select(['items' => ['*']], ['id' => $id]);
        if (count($rows) === 0) {
            return null;
        }

        $item = $this->createItemFromDatabaseRow($rows[0]);
        $this->addItem($item);

        return $item;
    }

    /**
     * Zet een database row om naar een Item object.
     *
     * @param array $row
     * @return Item
     */
    private function createItemFromDatabaseRow(array $row): Item
    {
        return new Item(
            $row['name'] ?? '',
            $row['type'] ?? '',
            (float)($row['value'] ?? 0),
            isset($row['id']) ? (int)$row['id'] : null
        );
    }
}
