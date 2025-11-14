<?php

namespace Game;

/**
 * Interface Database
 *
 * Deze interface definieert de basis CRUD-methoden voor een database.
 * Implementaties dienen de databaseverbinding op te zetten in hun constructor.
 */
interface Database
{
    /**
     * Insert een nieuw record in de opgegeven tabel.
     *
     * @param string $table De naam van de tabel waarin het record wordt toegevoegd.
     * @param array $data Een associatieve array van kolom => waarde paren voor het nieuwe record.
     * @return int Het ID van het nieuw ingevoegde record.
     */
    public function insert(string $table, array $data): int;

    /**
     * Selecteer records uit de database met optionele voorwaarden.
     *
     * @param array $tableColumns Een array van kolomnamen die moeten worden opgehaald.
     * @param array $conditions Optionele associatieve array van kolom => waarde paren voor WHERE-clausules.
     * @return array Een array van resultaten (associatieve arrays).
     */
    public function select(array $tableColumns, array $conditions = []): array;

    /**
     * Update bestaande records in de opgegeven tabel.
     *
     * @param string $table De naam van de tabel die moet worden bijgewerkt.
     * @param array $data Een associatieve array van kolom => nieuwe waarde paren.
     * @param array $conditions Een associatieve array van kolom => waarde paren voor WHERE-clausules.
     * @return int Het aantal rijen dat is gewijzigd.
     */
    public function update(string $table, array $data, array $conditions): int;

    /**
     * Verwijder records uit de opgegeven tabel.
     *
     * @param string $table De naam van de tabel waaruit records moeten worden verwijderd.
     * @param array $conditions Een associatieve array van kolom => waarde paren voor WHERE-clausules.
     * @return int Het aantal verwijderde rijen.
     */
    public function delete(string $table, array $conditions): int;

    /**
     * Haal het ID op van het laatst ingevoegde record.
     *
     * @return int Het laatst ingevoegde ID.
     */
    public function getLastInsertId(): int;

    /**
     * Test de verbinding met de database.
     *
     * @return bool True als de verbinding succesvol is, anders false.
     */
    public function testConnection(): bool;
}
