<?php
namespace App\Models;

use PDO;

class Visitor {
    public ?int $id;
    public string $name;
    public string $email;
    public string $ticketNumber;
    public string $visitDate;
    public ?string $ticketType;
    public int $persons;
    public float $totalPrice;
    public string $createdAt;

    public function __construct(
        string $name,
        string $email,
        string $ticketNumber,
        string $visitDate,
        ?string $ticketType = null,
        int $persons = 1,
        float $totalPrice = 0.0,
        ?int $id = null,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->ticketNumber = $ticketNumber;
        $this->visitDate = $visitDate;
        $this->ticketType = $ticketType;
        $this->persons = $persons;
        $this->totalPrice = $totalPrice;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s');
    }

    public function save() {
        $pdo = Database::getConnection();
        if ($this->id === null) {
            $stmt = $pdo->prepare("
                INSERT INTO visitors (name,email,ticket_number,visit_date,ticket_type,persons,total_price,created_at)
                VALUES (:name,:email,:ticket,:visit,:type,:persons,:total,:created)
            ");
            $stmt->execute([
                ':name' => $this->name,
                ':email' => $this->email,
                ':ticket' => $this->ticketNumber,
                ':visit' => $this->visitDate,
                ':type' => $this->ticketType,
                ':persons' => $this->persons,
                ':total' => $this->totalPrice,
                ':created' => $this->createdAt
            ]);
            $this->id = (int)$pdo->lastInsertId();
        }
    }

    // ✅ Bezoekers ophalen — gesorteerd op aanmaakdatum (recentste bovenaan)
    public static function getAll(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM visitors ORDER BY created_at DESC");
        $visitors = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $visitors[] = new Visitor(
                $row['name'], $row['email'], $row['ticket_number'], $row['visit_date'],
                $row['ticket_type'], (int)$row['persons'], (float)$row['total_price'],
                (int)$row['id'], $row['created_at']
            );
        }
        return $visitors;
    }

    public static function deleteById(int $id): bool {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM visitors WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function getMonthlyStats(): array {
        $pdo = Database::getConnection();

        $stmt = $pdo->query("
            SELECT 
                DATE_FORMAT(visit_date, '%Y-%m') AS month,
                ticket_type,
                COUNT(*) AS total_reservations,
                SUM(persons) AS total_persons,
                SUM(total_price) AS total_revenue
            FROM visitors
            GROUP BY month, ticket_type
            ORDER BY month DESC
        ");

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $month = $row['month'];
            if (!isset($data[$month])) {
                $data[$month] = [
                    'month' => $month,
                    'types' => [],
                    'total_reservations' => 0,
                    'total_persons' => 0,
                    'total_revenue' => 0
                ];
            }

            $data[$month]['types'][$row['ticket_type']] = [
                'count' => (int)$row['total_reservations'],
                'persons' => (int)$row['total_persons'],
                'revenue' => (float)$row['total_revenue']
            ];

            $data[$month]['total_reservations'] += (int)$row['total_reservations'];
            $data[$month]['total_persons'] += (int)$row['total_persons'];
            $data[$month]['total_revenue'] += (float)$row['total_revenue'];
        }

        return $data;
    }

    public static function getStatsByMonth(int $year, int $month): array {
        $db = Database::getConnection();

        // Query 1: gegevens per ticket type
        $stmt = $db->prepare("
        SELECT 
            ticket_type AS ticket_type, 
            COUNT(*) AS count,
            SUM(persons) AS persons,
            SUM(total_price) AS revenue
        FROM visitors
        WHERE YEAR(visit_date) = :year 
          AND MONTH(visit_date) = :month
        GROUP BY ticket_type
    ");
        $stmt->execute(['year' => $year, 'month' => $month]);
        $types = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Query 2: totaaloverzicht
        $stmt2 = $db->prepare("
        SELECT 
            COUNT(*) AS total_reservations,
            SUM(persons) AS total_persons,
            SUM(total_price) AS total_revenue
        FROM visitors
        WHERE YEAR(visit_date) = :year 
          AND MONTH(visit_date) = :month
    ");
        $stmt2->execute(['year' => $year, 'month' => $month]);
        $totals = $stmt2->fetch(\PDO::FETCH_ASSOC);

        return [
            'types' => $types ?: [],
            'total_reservations' => $totals['total_reservations'] ?? 0,
            'total_persons' => $totals['total_persons'] ?? 0,
            'total_revenue' => $totals['total_revenue'] ?? 0
        ];
    }
    public static function searchByName(string $name): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
        SELECT * FROM visitors 
        WHERE name LIKE :name 
        ORDER BY created_at DESC
    ");
        $stmt->execute([':name' => "%{$name}%"]);

        $visitors = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $visitors[] = new Visitor(
                $row['name'], $row['email'], $row['ticket_number'], $row['visit_date'],
                $row['ticket_type'], (int)$row['persons'], (float)$row['total_price'],
                (int)$row['id'], $row['created_at']
            );
        }
        return $visitors;
    }

}
