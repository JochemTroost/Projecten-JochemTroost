<?php
namespace App\Models;

use InvalidArgumentException;

class Shift
{
    public function __construct(
        private ?int $id,
        private int $employeeId,
        private string $shiftDate,  // YYYY-MM-DD
        private string $startTime,  // HH:MM:SS
        private string $endTime,    // HH:MM:SS
        private ?string $location
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function getDate(): string { return $this->shiftDate; }
    public function getStart(): string { return $this->startTime; }
    public function getEnd(): string { return $this->endTime; }
    public function getLocation(): ?string { return $this->location; }

    public static function validate(array $d): array
    {
        $errors = [];
        $eid = (int)($d['employee_id'] ?? 0);
        $date = trim($d['shift_date'] ?? '');
        $start = trim($d['start_time'] ?? '');
        $end = trim($d['end_time'] ?? '');
        if ($eid <= 0) $errors['employee_id'] = 'Medewerker is verplicht';
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) $errors['shift_date'] = 'Ongeldige datum (YYYY-MM-DD)';
        if (!preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $start)) $errors['start_time'] = 'Ongeldige tijd (HH:MM)';
        if (!preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $end)) $errors['end_time'] = 'Ongeldige tijd (HH:MM)';
        if (!$errors && strtotime($start) >= strtotime($end)) $errors['time_range'] = 'Eindtijd moet na starttijd liggen';
        return $errors;
    }

    public static function forEmployee(int $employeeId, ?string $from = null, ?string $to = null): array
    {
        $pdo = Database::getConnection();
        $sql = 'SELECT * FROM shifts WHERE employee_id = ?';
        $params = [$employeeId];
        if ($from) { $sql .= ' AND shift_date >= ?'; $params[] = $from; }
        if ($to)   { $sql .= ' AND shift_date <= ?'; $params[] = $to; }
        $sql .= ' ORDER BY shift_date, start_time';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map(fn($r) => new self((int)$r['id'], (int)$r['employee_id'], $r['shift_date'], $r['start_time'], $r['end_time'], $r['location'] ?? null), $rows);
    }

    public static function create(array $d): self
    {
        $errors = self::validate($d);
        if ($errors) throw new InvalidArgumentException(json_encode($errors, JSON_UNESCAPED_UNICODE));
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO shifts (employee_id, shift_date, start_time, end_time, location) VALUES (?,?,?,?,?)');
        $stmt->execute([(int)$d['employee_id'], $d['shift_date'], $d['start_time'], $d['end_time'], $d['location'] ?? null]);
        $id = (int)$pdo->lastInsertId();
        $created = $pdo->prepare('SELECT * FROM shifts WHERE id=?');
        $created->execute([$id]);
        $r = $created->fetch();
        return new self($id, (int)$r['employee_id'], $r['shift_date'], $r['start_time'], $r['end_time'], $r['location'] ?? null);
    }
}