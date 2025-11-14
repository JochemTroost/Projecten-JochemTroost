<?php
namespace Game;

/**
 * Klasse voor een simpele inventory van items (strings).
 */
class Inventory
{
    /**
     * @var string[] Array van item-namen
     */
    private array $items;

    /**
     * @param string[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return string[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(string $item): void
    {
        $this->items[] = $item;
    }

    public function removeItem(string $item): void
    {
        $this->items = array_filter(
            $this->items,
            fn($i) => $i !== $item
        );
    }
}
