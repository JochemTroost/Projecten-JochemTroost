<?php
declare(strict_types=1);

namespace App\Models;

use InvalidArgumentException;
use PDO;

final class Attraction
{
    private int $id;
    private string $name;
    private int $capacity;
    private string $status;
    private int $waitTime;

    private const VALID_STATUSES = ['open','closed','maintenance'];

    public function __construct(int $id, string $name, int $capacity, string $status, int $waitTime)
    {
        $this->id = $id; $this->name = $name; $this->capacity = $capacity; $this->status = $status; $this->waitTime = $waitTime;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getCapacity(): int { return $this->capacity; }
    public function getStatus(): string { return $this->status; }
    public function getWaitTime(): int { return $this->waitTime; }

    // Validation
    public static function validate(array $data): array
    {
        $errors = [];
        $name = trim((string)($data['name'] ?? ''));
        $capacity = filter_var($data['capacity'] ?? null, FILTER_VALIDATE_INT);
        $status = trim((string)($data['status'] ?? ''));
        $wait = filter_var($data['wait_time'] ?? null, FILTER_VALIDATE_INT);

        if ($name === '') $errors['name'] = 'Naam is verplicht';
        if ($capacity === false || $capacity <= 0) $errors['capacity'] = 'Capaciteit moet > 0 zijn';
        if (!in_array($status, self::VALID_STATUSES, true)) $errors['status'] = 'Ongeldige status';
        if ($wait === false || $wait < 0) $errors['wait_time'] = 'Wachttijd kan niet negatief zijn';

        return $errors;
    }

    private static function fromRow(array $r): self
    {
        return new self((int)$r['id'], (string)$r['name'], (int)$r['capacity'], (string)$r['status'], (int)$r['wait_time']);
    }

    // CRUD
    public static function all(): array
    {
        $pdo = DataBase::getConnection();
        $stmt = $pdo->query('SELECT id,name,capacity,status,wait_time FROM attractions ORDER BY name');
        return array_map(fn($r) => self::fromRow($r), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function find(int $id): ?self
    {
        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare('SELECT id,name,capacity,status,wait_time FROM attractions WHERE id=?');
        $stmt->execute([$id]);
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        return $r ? self::fromRow($r) : null;
    }

    public static function create(array $data): self
    {
        $errors = self::validate($data);
        if ($errors) throw new InvalidArgumentException(json_encode($errors, JSON_UNESCAPED_UNICODE));

        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare('INSERT INTO attractions (name,capacity,status,wait_time) VALUES (?,?,?,?)');
        $stmt->execute([trim((string)$data['name']), (int)$data['capacity'], trim((string)$data['status']), (int)$data['wait_time']]);
        return self::find((int)$pdo->lastInsertId());
    }

    public function update(array $data): self
    {
        $errors = self::validate($data);
        if ($errors) throw new InvalidArgumentException(json_encode($errors, JSON_UNESCAPED_UNICODE));

        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare('UPDATE attractions SET name=?, capacity=?, status=?, wait_time=? WHERE id=?');
        $stmt->execute([trim((string)$data['name']), (int)$data['capacity'], trim((string)$data['status']), (int)$data['wait_time'], $this->id]);
        return self::find($this->id);
    }

    public function delete(): void
    {
        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare('DELETE FROM attractions WHERE id=?');
        $stmt->execute([$this->id]);
    }
}