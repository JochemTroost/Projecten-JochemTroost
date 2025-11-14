<?php

namespace Game;

use Game\Character;

/**
 * Class CharacterList
 *
 * Beheert een collectie van Character-objecten
 */
class CharacterList
{
    /**
     * @var Character[] $characters
     * Array waarin alle Character-objecten worden opgeslagen
     */
    private array $characters = [];

    /**
     * Voeg een Character toe aan de lijst
     *
     * @param Character $character
     * @return string
     */
    public function addCharacter(Character $character): string
    {
        $this->characters[] = $character;
        return "Character {$character->getName()} added to list";
    }

    /**
     * Haal alle Characters op
     *
     * @return Character[]
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * Haal een specifiek Character op via naam
     *
     * @param string $name
     * @return Character|string
     */
    public function getCharacter(string $name): Character|string
    {
        foreach ($this->characters as $character) {
            if ($character->getName() === $name) {
                return $character;
            }
        }
        return "Character not found";
    }

    /**
     * Verwijder een Character uit de lijst en update statistics
     *
     * @param Character $character
     * @return string
     */
    public function removeCharacter(Character $character): string
    {
        $key = array_search($character, $this->characters, true);
        if ($key !== false) {
            // VOORDAT het character wordt verwijderd: naam en rol ophalen
            $name = $character->getName();
            $role = $character->getRole();

            // Character uit de array verwijderen
            unset($this->characters[$key]);
            $this->characters = array_values($this->characters); // herindexeren

            // Statistics bijwerken
            Character::removeCharacterFromStats($name, $role);

            return "Character {$name} removed from list";
        }
        return "Character {$character->getName()} not found in list";
    }
}
