<?php
namespace App\Controllers;

use App\Models\Visitor;

class VisitorController {
    public function addVisitor(
        string $name,
        string $email,
        string $ticketNumber,
        string $visitDate,
        ?string $ticketType = null,
        int $persons = 1,
        float $totalPrice = 0.0
    ): void {
        $visitor = new Visitor($name, $email, $ticketNumber, $visitDate, $ticketType, $persons, $totalPrice);
        $visitor->save();
    }

    /**
     * Haalt alle bezoekers op, gesorteerd op aanmaakdatum (recentste eerst)
     */
    public function getVisitors(): array {
        return Visitor::getAll();
    }

    /**
     * ✅ Nieuwe functie — zoekt bezoekers op naam (case-insensitive)
     */
    public function searchVisitors(string $name): array {
        return Visitor::searchByName($name);
    }

    public function deleteVisitor(int $id): void {
        Visitor::deleteById($id);
    }

    public function getMonthlyStats(): array {
        return Visitor::getMonthlyStats();
    }

    public function getStatsByMonth(int $year, int $month): array {
        $data = Visitor::getStatsByMonth($year, $month);

        return array_merge([
            'types' => [],
            'total_reservations' => 0,
            'total_persons' => 0,
            'total_revenue' => 0
        ], $data);
    }
}
